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

if(isset($_POST['guest-comment'])) {
    $comment = $_POST['guest-comment'];

    if(trim(strlen($comment)) < 5 || trim(strlen($comment)) > 255){
        $errors[] = "Comment must have at least 5 characters, and max 255 characters.";
    }
    else {
        if(getGuestCommentInfo($pdo, $event_id, $guest_id) == 0) { // Check if user already sent comment
            insertComment($pdo, $event_id, $guest_id, $comment); // Function that inserts a guest comment
            updateGuestComment($pdo, $event_id, $guest_id); // Function that prevents the guest from sending a comment again
            redirection('./event_invitation.php?ei=24&event_id='. $event_id . '&guest_id=' .$guest_id. '&token='.$token);
        }
        else {
            redirection('./event_invitation.php?ei=20&event_id='. $event_id . '&guest_id=' .$guest_id. '&token='.$token);
        }
    }
}

if(isset($_POST['flexRadioDefault'])) {
    $is_coming = $_POST['flexRadioDefault'];
    guestUpdateRespone($pdo, $event_id, $guest_id, $is_coming, $wish_id); // Function that updates the guest response
    redirection('./event_invitation.php?ei=22&event_id='. $event_id . '&guest_id=' .$guest_id. '&token='.$token);
}
else { // If user didn't answer that he is coming or not, set error message
   if(!isset($_POST['guest-comment'])) {
       $errors[] = "You must answer that you are coming or not to be able to send.";
   }
}

if($errors) { // Server validation error messages
    $_SESSION['event_invitation_errors'] = $errors;
    redirection('./event_invitation.php?event_id=' .$event_id . '&guest_id=' . $guest_id . '&token='.$token);
}



