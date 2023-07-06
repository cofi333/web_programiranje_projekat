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

$sql2 = "SELECT event_id, guest_id, is_coming,comment_sent FROM guest_event WHERE event_id=".$event_id . " AND guest_id=".$guest_id;
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
    $ei = 0;

    if (isset($_GET["ei"]) and is_numeric($_GET['ei'])) {
        $ei = (int)$_GET["ei"];

        if (array_key_exists($ei, $messages)) {
            echo '
                    <div class="alert alert-info ~alert-dismissible fade show m-3" role="alert">
                        ' . $messages[$ei] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    ';
        }
    }
    ?>


    <form action="./event_invitation-data.php" method="post" id="form">
        <?php
        if( date("Y-m-d H:i:s")  > ($result['event_date'] . " " . $result['event_time'])) {
            if($result['event_comments'] == "on") {
                if( $result2 && $result2['comment_sent'] == 1) {
                    echo 'you already sent the comment. thank you.';
                }
                else {
                    echo ' <div class="form-group">
                <textarea class="form-control" name="guest-comment" placeholder="Enter a comment about how did you spent time at this event" id="exampleFormControlTextarea1" rows="1"></textarea>
        </div>
                <input type="submit" id="submit-btn" class="btn btn-primary" value="Submit"/>';
                }
            }
        }
        else {
            echo ' 
       <div class="rd-btns">
        <div class="form-check">
            <input class="form-check-input radio_btns"';  if($result2 && $result2['is_coming'] == 1)  echo "checked";  echo ' type="radio" value="1" name="flexRadioDefault" id="flexRadioDefault2">
            <label class="form-check-label radio_btns" for="flexRadioDefault2">
                Coming
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input radio_btns"'; if($result2 && $result2['is_coming'] == 0)  echo "checked"; echo ' type="radio" value="0" name="flexRadioDefault" id="flexRadioDefault1">
            <label class="form-check-label radio_btns" for="flexRadioDefault1">
                Not coming
            </label>
        </div>
       </div>
               <input type="submit" id="submit-btn" class="btn btn-primary" value="Submit"/>';
        }
        ?>
        <input type="hidden" name="event_id" value="<?php echo $event_id ?>"/>
        <input type="hidden" name="guest_id" value="<?php echo $guest_id ?>"/>
    </form>


</section>

</body>



<script src="../node_modules\bootstrap\dist\js\bootstrap.bundle.min.js"></script>
</html>