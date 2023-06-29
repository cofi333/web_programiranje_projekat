<?php
require_once 'config.php';
if (isset($_GET['event_id'])) {
    $event_id = trim($_GET['event_id']);
}

$sql = $pdo->prepare("SELECT events.event_id, events.ec_id, events.event_organizer, events.event_title, events.event_date, events.event_time,events.event_location ,events.event_description, event_category.category FROM events INNER JOIN event_category ON events.ec_id = event_category.ec_id WHERE event_id =". $event_id);
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
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body id="reset_form_body">
<section class="reset_form container">
    <div class="content">
        <div class="form">
            <form action="./update-event-data.php" method="post" id="form">
                <div class="form-group">
                    <label for="event-title">Event title</label>
                    <input type="text" class="form-control" id="event-title" name="event-title" aria-describedby="emailHelp" value="<?php echo $result['event_title'] ?>">

                </div>
                <div class="form-group">
                    <label for="event-organizer">Organizer</label>
                    <input type="text" class="form-control" id="event-organizer" name="event-organizer" value="<?php echo $result['event_organizer'] ?>">

                </div>

                <div class="row event_type">
                    <div class="col-md-3">
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
                               } ?>
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
                    <input type="text" class="form-control" id="event-description" name="event-description" value="<?php echo $result['event_description'] ?>">
                </div>

               <div class="update-btn">
                   <input type="hidden" name="event_id" value="<?php echo $result['event_id']?>">
                   <input type="submit" name="btnSubmit" class="btn btn-primary" value="Update" />
               </div>

            </form>
        </div>

    </div>

</section>

</body>


<script src="../node_modules\bootstrap\dist\js\bootstrap.bundle.min.js"></script>
</html>

