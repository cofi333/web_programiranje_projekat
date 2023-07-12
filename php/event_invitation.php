<?php
session_start();

require_once './config.php';


if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
}
if (isset($_GET['guest_id'])) {
    $guest_id = $_GET['guest_id'];
}

if(isset($_GET['token'])) {
    $token = $_GET['token'];
}

try {
    $sql = "SELECT * FROM events WHERE event_id = " . $event_id;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql2 = "SELECT event_id, guest_id, is_coming,comment_sent,wish_id FROM guests WHERE event_id=".$event_id . " AND guest_id=".$guest_id . " AND guest_token=:token";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->bindParam(':token', $token, PDO::PARAM_STR);
    $stmt2->execute();
    $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    $sql3 = "SELECT wish_id, wish_gift_name FROM wish_list WHERE event_id=".$event_id;
    $stmt3 = $pdo ->query($sql3);
    $stmt3->setFetchMode(PDO::FETCH_ASSOC);
}

catch(PDOException $e) {
    var_dump($e->getCode());
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
    <title>Event invitation</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<?php
if($result2 === false) {
    exit("<body id='removed-guest-body'><div class='content'>
                <h2>You have been removed from guest list. Contact organizer for more information.</h2>
                <div class='buton'>
                  <a href='../index.php' class='btn btn-primary'>Home</a>    
                    
                </div>
                </div></body>");
}
?>

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
                <input type="submit" id="submit-btn" class="btn btn-primary" value="Send"/>';
                }
            }
        }
        else {
            echo ' 
       <div class="rd-btns">
        <div class="form-check">
            <input class="form-check-input radio_btns"';  if($result2 && $result2['is_coming'] === 1)  echo "checked";  echo ' type="radio" value="1" name="flexRadioDefault" id="flexRadioDefault2">
            <label class="form-check-label radio_btns" for="flexRadioDefault2">
                Coming
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input radio_btns"'; if($result2 && ($result2['is_coming']) === 0)  echo "checked"; echo ' type="radio" value="0" name="flexRadioDefault" id="flexRadioDefault1">
            <label class="form-check-label radio_btns" for="flexRadioDefault1">
                Not coming
            </label>
        </div>
       </div>
        <select class="form-select" name="gift-list" id="gift-list" aria-label="Default select example">
            <option selected value="default">You can select a gift</option>';
        while($row = $stmt3 -> fetch()) {
            if($result2['wish_id'] === $row['wish_id']) {
                echo '<option selected value="' .  $row['wish_id'] .'">' . $row['wish_gift_name'] . ' </option>';
            }
            else {
                echo '<option value="' .  $row['wish_id'] .'">' . $row['wish_gift_name'] . '</option>';
            }
        }
        echo '
        </select>
               <input type="submit" id="submit-btn" class="btn btn-primary" value="Send"/>';
        }
        ?>
        <input type="hidden" name="token" value="<?php echo $token ?>"/>
        <input type="hidden" name="event_id" value="<?php echo $event_id ?>"/>
        <input type="hidden" name="guest_id" value="<?php echo $guest_id ?>"/>
    </form>


</section>

</body>



<script src="../node_modules\bootstrap\dist\js\bootstrap.bundle.min.js"></script>
</html>