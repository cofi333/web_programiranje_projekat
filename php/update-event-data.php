<?php
require_once './functions.php';
require_once './config.php';

if (isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];
}



if (isset($_POST['event-title'])) {
    $new_title = $_POST['event-title'];
}

if (isset($_POST['event-organizer'])) {
    $new_organizer = $_POST['event-organizer'];
}

if (isset($_POST['event-category'])) {
    $new_category = $_POST['event-category'];
}

if (isset($_POST['event-location'])) {
    $new_location = $_POST['event-location'];
}

if (isset($_POST['event-date'])) {
    $new_date = $_POST['event-date'];
}

if (isset($_POST['event-time'])) {
    $new_time = $_POST['event-time'];
}

if (isset($_POST['event-description'])) {
    $new_description = $_POST['event-description'];
}

if(isset($_POST['event-comments'])) {
    $comments = $_POST['event-comments'];
}
else {
    $comments = "off";
}

updateEvent($pdo, $event_id ,$new_category, $new_title, $new_organizer, $new_location, $new_date, $new_time, $new_description, $comments);
redirection('../user_profile.php');
