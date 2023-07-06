<?php
session_start();
require_once './functions.php';
require_once './config.php';

if (isset($_SESSION['id_user'])) {
    $user_id = $_SESSION['id_user'];
}

if (isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];
}

if(isset($_POST['guest-email'])) {
    $guest_email = $_POST['guest-email'];
}

if(isset($_POST['guest-name'])) {
    $guest_name = $_POST['guest-name'];
}


if(is_numeric(getGuestId($pdo, $guest_email, $event_id))) {
    redirection('./send-invitation.php?si=19&event_id='.$event_id);
}

else {
    insertGuest($pdo,$event_id,$user_id, $guest_email, $guest_name);

    $result = getGuestId($pdo,$guest_email, $event_id);

    try {
        $body = "You are invited to the event. Click on the <a href=" . SITE . "php/event_invitation.php?event_id=".$event_id."&guest_id=".$result."> link </a> and let the organizer know if you are coming to the event.";
        sendEmail($pdo, $guest_email, $emailMessages['invitation'], $body);
        redirection("../user_profile.php?i=1");
    } catch (Exception $e) {
        error_log("****************************************");
        error_log($e->getMessage());
        error_log("file:" . $e->getFile() . " line:" . $e->getLine());
        redirection("../user_profile.php?i=2");
    }
}






