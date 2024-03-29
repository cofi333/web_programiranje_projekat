<?php
session_start();
require_once 'config.php';
if (isset($_GET['event_id'])) {
    $event_id = trim($_GET['event_id']);
} else{
    redirection('../user_profile.php');
    exit();
}

try {
    $sql = $pdo->prepare("SELECT  guests.guest_id, guests.guest_name, guests.guest_mail, guests.is_coming,wish_list.wish_gift_name FROM guests LEFT JOIN wish_list ON guests.wish_id = wish_list.wish_id WHERE guests.event_id =".$event_id);
    $sql2 = $pdo->prepare("SELECT event_id, event_title FROM events WHERE event_id=" .$event_id);
    $sql->execute();
    $sql2->execute();
    $result = $sql->fetchAll();
    $result2 = $sql2->fetch();

}
catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    throw new \PDOException($e->getMessage());
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/style.css">
    <title>Send an invitation</title>
</head>
<body id="send-invitation">

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 links">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Home</a>
            </ul>

            <ul class="navbar-nav buttons">
                <li class="nav-item create_event_btn">
                    <a class="nav-link" href="../event.php">Create an event</a>
                </li>
            </ul>

            <div class="user">
                <a href="../user_profile.php"><img src="../images/user_image.png" id="user_image" alt="user-profile"></a>
            </div>
        </div>
    </div>
</nav>

<section class="center_form container-lg">
    <h2 class="invitation-header">Send an invitation for <?php echo $result2['event_title'] ?></h2>

    <div class="content">
        <div class="form">
            <form action="./send-invitation-data.php" method="post" id="form">
                <?php
                require_once './config.php';
                $si = 0;

                if (isset($_GET["si"]) and is_numeric($_GET['si'])) {
                    $si = (int)$_GET["si"];

                    if (array_key_exists($si, $messages)) {
                        echo '
                    <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
                        ' . $messages[$si] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    ';
                    }
                }


                if (isset($_SESSION['invitation_errors'])) {
                    foreach ($_SESSION['invitation_errors'] as $value) {
                        echo '
                    <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                        ' . $value . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    ';
                    }
                    unset($_SESSION['invitation_errors']);
                }


                ?>
                <div class="form-group">
                    <label for="guest-email">Guest email:</label>
                    <input type="email" class="form-control" id="guest-email" name="guest-email" aria-describedby="emailHelp">
                    <span class="error" id="email-error"></span>
                </div>
                <div class="form-group">
                    <label for="guest-name">Guest name:</label>
                    <input type="text" class="form-control" id="guest-name" name="guest-name">
                    <span class="error" id="name-error"></span>
                </div>

                <div class="btn-form">
                    <input type="hidden" name="event_id" value="<?php echo $result2['event_id'] ?>"/>
                    <input type="submit" name="btnSubmit" class="btn btn-primary" value="Send" />
                </div>

            </form>
        </div>

    </div>

</section>

<section class="guests-list container-lg">
    <h2 class="invitation-header">List of currently invited guests</h2>
    <select class="form-select form-select-sm" id="response-select">
        <option selected disabled>Filter responses by</option>
        <option value="1">Coming</option>
        <option value="0">Not coming</option>
    </select>

    <div class="list table-responsive-lg">
            <table class="table table-primary table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="min-width150">Name</th>
                    <th scope="col" class="min-width300">Mail</th>
                    <th scope="col" class="min-width100">Response</th>
                    <th scope="col" class="min-width300">Gift item</th>
                    <th scope="col" class="min-width300">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $number = 1;
                foreach($result as $data) {

                    if(is_numeric($data['is_coming'])) {
                        if($data['is_coming'] === 0 ) {
                            $is_coming = 'Not coming';
                        }
                        else {
                            $is_coming = 'Coming';
                        }
                    }
                    else {
                        $is_coming= 'Did not answered yet';
                    }

                    echo  '<tr>
                     <th scope="row">' . $number . '</th>
                     <td>' . $data['guest_name'] . '</td>
                     <td>' . $data['guest_mail'] . '</td>
                     <td>' . $is_coming . '</td>
                     <td>' . $data['wish_gift_name'] . '</td>
                     <td> <a class="btn btn-warning update-event" onclick="getId('.$data['guest_id'].')" role="button" data-bs-toggle="modal" data-bs-target="#update-guest-modal">Update guest</a>
                            <a id="delButton" class="btn btn-danger" onclick="getId('.$data['guest_id'].')" data-bs-toggle="modal" data-bs-target="#delete-guest-modal" role="button">Delete guest</a></td>
                   </tr> ';
                    $number++;
                }
                ?>
                </tbody>
            </table>
        </div>

</section>

<div class="modal fade" id="delete-guest-modal" tabindex="-1" aria-labelledby="delete-guest-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Deleting a guest</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to remove this guest from list?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="" id="delete-guest" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="update-guest-modal" tabindex="-1" aria-labelledby="update-guest-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update guest info</h1>
                <button type="button" class="btn-close close-modal-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="./update-guest.php" id="form2" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" name="guest-new-name" class="form-control" id="guest-new-name" placeholder="Your name">
                        <span class="error" id="new-name-error"></span>
                        <label for="floatingName">Name</label>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-modal-btn" data-bs-dismiss="modal">Cancel</button>
                        <input type="hidden" id="input-guest-id" name="guest-id" value="">
                        <input type="hidden" id="input-event-id" name="event-id" value="">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>

<script src="../script/invitationValidateForm.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="../script/updateGuestValidateForm.js"></script>
<script>

    let event_id= "<?php Print($_GET['event_id']) ?>";
    $(document).ready(function() {
        $("#response-select").on('change', function() {
            let value = $(this).val();

            $.ajax({
                url: "../php/fetchData/fetch-responses.php?event_id="+event_id,
                type: "POST",
                data: "request=" + value,
                success: function(data) {
                    $(".list").html(data);
                }

            });
        })
    });

    let getId = (id) => {
        let deleteBtn = document.getElementById("delete-guest");
        let inputUpdate = document.getElementById("input-guest-id");
        let eventIdValue = document.getElementById("input-event-id");
        deleteBtn.href = "./delete-guest.php?guest_id=" + id + "&event_id="+ event_id;
        inputUpdate.value = id;
        eventIdValue.value = event_id;
    }
</script>

</html>

