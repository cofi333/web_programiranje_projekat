<?php
session_start();
require_once 'config.php';
if (isset($_GET['event_id'])) {
    $event_id = trim($_GET['event_id']);
} else{
    redirection('../user_profile.php');
    exit();
}

$sql = $pdo->prepare("SELECT events.event_id, events.ec_id, events.event_organizer, events.event_title, events.event_date, events.event_time,events.event_location ,events.event_description, events.event_comments, event_category.category FROM events INNER JOIN event_category ON events.ec_id = event_category.ec_id WHERE event_id =". $event_id);
$sql->execute();
$result = $sql->fetch();
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
    <title>Update <?php echo $result['event_title'] ?></title>
</head>
<body id="center_form">

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
    <div class="content">
        <div class="form">
            <form action="./update-event-data.php" method="post" id="form">
                <?php

                $ue = 0;

                if (isset($_GET["ue"]) and is_numeric($_GET['ue'])) {
                    $ue = (int)$_GET["ue"];

                    if (array_key_exists($ue, $messages)) {
                        echo '
                    <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
                        ' . $messages[$ue] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    ';
                    }
                }


                if (isset($_SESSION['update_event_errors'])) {
                    foreach ($_SESSION['update_event_errors'] as $value) {
                        echo '
                    <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                        ' . $value . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    ';
                    }
                    unset($_SESSION['update_event_errors']);
                }


                ?>
                <span class="error" id="error"></span>
                <div class="form-group">
                    <label for="event-title">Event title</label>
                    <input type="text" class="form-control" id="event-title" name="event-title" value="<?php echo $result['event_title'] ?>">

                </div>
                <div class="form-group">
                    <label for="event-organizer">Organizer</label>
                    <input type="text" class="form-control" id="event-organizer" name="event-organizer" value="<?php echo $result['event_organizer'] ?>">

                </div>

                <div class="row event_type">
                    <div class="col-xl-3">
                       <div class="form-group">
                           <label>Category</label>
                           <select class="form-select" name="event-category" id="event-category" aria-label="Default select example">
                               <?php

                               $sql = "SELECT ec_id,category FROM event_category";
                               $q = $pdo -> query($sql);
                               $q -> setFetchMode(PDO::FETCH_ASSOC);

                               while($row = $q -> fetch()) {

                                   if($row['ec_id'] == $result['ec_id']) {
                                       ?>  <option selected value="<?php echo ($row['ec_id'])?>"><?php echo htmlspecialchars($row['category'])?></option>
                                   <?php }
                                   else {
                                       ?>  <option value="<?php echo ($row['ec_id'])?>"><?php echo htmlspecialchars($row['category'])?></option>
                                   <?php }
                               }
                               ?>
                           </select>
                       </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="event-location">Location</label>
                    <input type="text" class="form-control" id="event-location" name="event-location" value="<?php echo $result['event_location'] ?>">

                </div>

                <div class="date_time">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="organizer" class="form-label">Date</label>
                                <input type="date" id="event-date" class="form-control" name="event-date" value="<?php echo $result['event_date'] ?>">
                                <span class="error" id="event-date_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="organizer" class="form-label">Time</label>
                                <input type="text" id="event-time" class="form-control" name="event-time" value="<?php echo $result['event_time'] ?>" placeholder="HH:MM:SS">
                                <span class="error" id="event-time_error"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="event-description">Description</label>
                    <textarea type="text" class="form-control" id="event-description" name="event-description"><?php echo $result['event_description'] ?></textarea>
                </div>

                <div class="form-group">
                        <div class="switch">
                            <label class="form-check-label" for="flexSwitchCheckChecked">Comments</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="event-comments" role="switch" id="flexSwitchCheckChecked" <?php if($result['event_comments'] == "on") echo "checked";?> >
                            </div>
                        </div>
                </div>


                <div class="btn-form">
                   <input type="hidden" name="event_id" value="<?php echo $result['event_id']?>">
                   <input type="submit" id="update-btn" class="btn btn-primary" value="Update"/>
               </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update event</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to update event?</p>
                            </div>
                            <div class="modal-footer">
                                <buton data-bs-dismiss="modal" aria-label="Close" class="btn btn-secondary">Cancel</buton>
                                <input type="submit" class="btn btn-primary" id="modal-submit" value="Submit">
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>


    </div>

</section>




</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../script/updateEventValidateForm.js"></script>
</html>

