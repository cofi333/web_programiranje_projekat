<?php
require_once 'config.php';

if(isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
}


try {
    $sql = $pdo->prepare("SELECT wish_id,wish_gift_name, wish_gift_link FROM wish_list WHERE event_id=".$event_id);
    $sql->execute();
    $result = $sql->fetchAll();
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
    <link rel="stylesheet" href="../css/style.css">
    <title>Wish list</title>
</head>
<body id="wish-list">
<section class="center_form container-lg">
    <div class="content">
        <div class="form">
            <form action="./wish-list-data.php" method="post" id="form">
                <div class="form-group">
                    <label for="gift-name">Gift name:</label>
                    <input type="text" class="form-control" id="gift-name" name="gift-name">
                    <span class="error" id="gift-name-error"></span>
                </div>
                <div class="form-group">
                    <label for="gift-link">Gift link:</label>
                    <input type="text" class="form-control" id="gift-link" name="gift-link">
                    <span class="error" id="gift-link-error"></span>
                </div>

                <div class="btn-form">
                    <input type="hidden" name="event_id" value="<?php echo $event_id?>"/>
                    <input type="submit" name="btnSubmit" class="btn btn-primary" value="Add" />
                </div>

            </form>
        </div>

    </div>

</section>

<section class="wish-list container">
    <h2 class="invitation-header">List of currently added gifts</h2>

    <div class="list">
        <table class="table table-primary table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Link</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $number=1;

                    foreach($result as $data) {
                        echo '<tr>
                            <th scope="row">'. $number . '</th>
                            <td>' . $data['wish_gift_name'] . '</td>
                            <td><a href="' . $data['wish_gift_link'] . '" target="_blank"> Link of product</a></td>
                            <td><a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#update-gift-modal">Update gift</a>
                            <a class="btn btn-danger" onclick="getId('.$data['wish_id'].')" role="button" data-bs-toggle="modal" data-bs-target="#delete-gift-modal">Delete gift</a>
                            </td>
                    </tr>';
                        $number++;
                    }


                ?>
            </tbody>
        </table>


    </div>
</section>

<div class="modal fade" id="delete-gift-modal" tabindex="-1" aria-labelledby="delete-gift-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Deleting a gift</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to remove this gift from list?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="" id="delete-gift" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="update-gift-modal" tabindex="-1" aria-labelledby="update-gift-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update gift info</h1>
                <button type="button" class="btn-close close-modal-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="./update-gift.php" id="form2" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" name="gift-new-name" class="form-control" id="gift-new-name" placeholder="Your name">
                        <span class="error" id="gift-new-name-error"></span>
                        <label for="floatingName">Name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" name="gift-new-link" class="form-control" id="gift-new-link" placeholder="Your name">
                        <span class="error" id="gift-new-link-error"></span>
                        <label for="floatingName">Link</label>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-modal-btn" data-bs-dismiss="modal">Cancel</button>
                        <input type="hidden" id="input-gift-id" name="guest-id" value="">
                        <input type="hidden" id="input-event-id" name="event-id" value="">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>

<script src="../node_modules\bootstrap\dist\js\bootstrap.bundle.min.js"></script>
<script src="../script/wishListValidateForm.js"></script>
<script>

    let event_id= "<?php Print($_GET['event_id']) ?>";

    let getId = (id) => {
        let deleteBtn = document.getElementById("delete-gift");
        deleteBtn.href = "./delete-gift.php?wish_id=" + id + "&event_id="+ event_id;
    }

</script>
</html>