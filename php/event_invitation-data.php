<?php
session_start();
require_once 'config.php';

$errors = [];

if (isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];
}
if (isset($_POST['guest_id'])) {
    $guest_id = $_POST['guest_id'];
}

if(isset($_POST['token'])) {
    $token = $_POST['token'];
}

if(isset($_POST['gift-list'])){
    if($_POST['gift-list'] === "default") {
        $wish_id = NULL;
    }
    else {
        $wish_id = $_POST['gift-list'];
    }
}

try {
    $sql = "SELECT guest_id, event_id, comment_sent FROM guests WHERE event_id=".$event_id . " AND guest_id=" . $guest_id;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
    var_dump($e->getCode());
    throw new \PDOException($e->getMessage());
}


if(isset($_POST['guest-comment'])) {
    $comment = $_POST['guest-comment'];

    if(trim(strlen($comment)) < 5 || trim(strlen($comment)) > 255){
        $errors[] = "Comment must have at least 5 characters, and max 255 characters.";
    }
    else {

        if($result['comment_sent'] == 0) {

            insertComment($pdo, $event_id, $guest_id, $comment);

            try {
                $sql = "UPDATE guests SET comment_sent = 1 WHERE event_id=" . $event_id . " AND guest_id=" . $guest_id;
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
            } catch (PDOException $e) {
                var_dump($e->getCode());
                throw new \PDOException($e->getMessage());
            }

            redirection('./event_invitation.php?event_id='. $event_id . '&guest_id=' .$guest_id. '&token='.$token);

        }
        else {
            redirection('./event_invitation.php?ei=20&event_id='. $event_id . '&guest_id=' .$guest_id. '&token='.$token);
        }
    }
}


if(isset($_POST['flexRadioDefault'])) {
    $is_coming = $_POST['flexRadioDefault'];
    guestUpdateRespone($pdo, $event_id, $guest_id, $is_coming, $wish_id);
    redirection('./event_invitation.php?ei=22&event_id='. $event_id . '&guest_id=' .$guest_id. '&token='.$token);
}
else {
   if(!isset($_POST['guest-comment'])) {
       $errors[] = "You must answer that you are coming or not to be able to send.";
   }
}

if($errors) {
    $_SESSION['event_invitation_errors'] = $errors;
    redirection('./event_invitation.php?event_id=' .$event_id . '&guest_id=' . $guest_id . '&token='.$token);
}



