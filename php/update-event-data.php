<?php
session_start();
require_once './functions.php';
require_once './config.php';

$errors = [];

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

if(empty($new_title) || empty($new_organizer) || empty($new_category) || empty($new_location) || empty($new_date) || empty($new_time) || empty($new_description)) {
    $errors[] = "Fields can't be empty.";
}

if(is_numeric($new_title)) {
    $errors[] = "Please enter a valid title.";
}

if(trim(strlen($new_organizer)) < 3 ) {
    $errors[] = "Organizer must have at least 3 characters.";
}

if($new_category === "default") {
    $errors[] = "You must select category of your event.";
}

if(trim(strlen($new_location)) < 5) {
    $errors[] = "Please enter a valid location.";
}

if(!validateTime($new_time)) {
    $errors[] = "Time is not in valid form.";
}

if(trim(strlen($new_description)) < 15) {
    $errors[] = "Description must have at least 15 characters.";
}


function validateTime($date, $format = 'H:i:s') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

if(!$errors) {
    updateEvent($pdo, $event_id ,$new_category, $new_title, $new_organizer, $new_location, $new_date, $new_time, $new_description, $comments);
    redirection('./update-event.php?event_id='.$event_id."&ue=40");
}
else {
    $_SESSION['update_event_errors'] = $errors;
    redirection('./update-event.php?event_id='.$event_id);
}


