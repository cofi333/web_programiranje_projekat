<?php
require_once './config.php';

if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
}
if (isset($_GET['guest_id'])) {
    $guest_id = $_GET['guest_id'];
}

$sql = "SELECT * FROM events WHERE event_id = " . $event_id;
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$sql2 = "SELECT event_id, guest_id, is_coming FROM guest_event WHERE event_id=".$event_id . " AND guest_id=".$guest_id;
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute();
$result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Event invitation</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body id="event_page">

<section class="about_event container">
    <h2><?php echo $result['event_title'] ?></h2>
    <p><?php echo $result['event_description']?></p>
    <div class="event_date">
        <h2>Date:</h2>
        <p><?php echo $result['event_date']?></p>
    </div>
    <div class="event_time">
        <h2>Time:</h2>
        <p><?php echo $result['event_time']?></p>
    </div>
    <div class="event_location">
        <h2>Location:</h2>
        <p><?php echo $result['event_location']?></p>
    </div>
</section>

<section class="guest-coming container">
    <?php

    if($result2) {
        echo "<h2>Did you change your mind? You can change your response.</h2>";

    }
    else {
        echo "<h2>Please let the organizer know if you are coming to the event.</h2>";
    }

    ?>
    <form action="./event_invitation-data.php" method="post" id="form">

        <div class="form-check">
            <input class="form-check-input radio_btns" <?php if($result2['is_coming'] == 1) echo "checked" ?> type="radio" value="1" name="flexRadioDefault" id="flexRadioDefault2">
            <label class="form-check-label radio_btns" for="flexRadioDefault2">
                Coming
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input radio_btns" <?php if($result2['is_coming'] == 0) echo "checked" ?>  type="radio" value="0" name="flexRadioDefault" id="flexRadioDefault1">
            <label class="form-check-label radio_btns" for="flexRadioDefault1">
                Not coming
            </label>
        </div>

        <input type="hidden" name="event_id" value="<?php echo $event_id ?>"/>
        <input type="hidden" name="guest_id" value="<?php echo $guest_id ?>"/>
        <input type="submit" id="submit-btn" class="btn btn-primary" value="Submit"/>
    </form>
</section>

</body>



<script src="../node_modules\bootstrap\dist\js\bootstrap.bundle.min.js"></script>
</html>