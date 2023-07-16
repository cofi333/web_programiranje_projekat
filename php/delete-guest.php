<?php
require_once 'config.php';
require_once 'functions.php';
if(isset($_GET['guest_id'])) {
    $guest_id = $_GET['guest_id'];
}

if(isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
}


deleteGuest($pdo, $guest_id);

redirection('./send-invitation.php?event_id='.$event_id . "&si=38");