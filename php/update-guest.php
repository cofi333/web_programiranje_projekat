<?php
require_once './config.php';
require_once './functions.php';

if(isset($_POST['guest-id'])) {
    $guest_id = $_POST['guest-id'];
}

if(isset($_POST['guest-new-name'])) {
    $guest_name = $_POST['guest-new-name'];
}

if(isset($_POST['event-id'])) {
    $event_id = $_POST['event-id'];
}

updateGuestInfo($pdo, $guest_id, $guest_name);
redirection('./send-invitation.php?event_id='. $event_id);