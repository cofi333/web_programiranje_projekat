<?php
session_start();
require_once 'config.php';
require_once 'functions.php';

$errors = [];

if (isset($_SESSION['id_user'])) {
   $user_id = $_SESSION['id_user'];
}

if(isset($_POST['event-title'])) {
    $title = $_POST['event-title'];
}

if(isset($_POST['event-organizer'])) {
    $organizer = $_POST['event-organizer'];
}

if(isset($_POST['event-category'])) {
    $category = $_POST['event-category'];
}

if(isset($_POST['event-location'])) {
    $location = $_POST['event-location'];
}


if(isset($_POST['event-date'])) {
    $date = $_POST['event-date'];
}

if(isset($_POST['event-time'])) {
    $time = $_POST['event-time'];
}

if(isset($_POST['event-description'])) {
    $description = $_POST['event-description'];
}

if(isset($_POST['event-comments'])) {
    $comments = $_POST['event-comments'];
}
else {
    $comments = "off";
}

if(empty($title) || empty($organizer) || empty($category) || empty($location) || empty($date) || empty($time) || empty($description)) {
    $errors[] = "Fields can't be empty!";
}

if(is_numeric($title)) {
    $errors[] = "Please enter a valid title.";
}

if(trim(strlen($organizer)) < 3 ) {
    $errors[] = "Organizer must have at least 3 characters.";
}

if($category === "default") {
    $errors[] = "You must select category of your event.";
}

if(trim(strlen($location)) < 5) {
    $errors[] = "Please enter a valid location.";
}

if(!validateTime($time)) {
    $errors[] = "Time is not in valid form.";
}

if(trim(strlen($description)) < 15) {
    $errors[] = "Description must have at least 15 characters.";
}


function validateTime($date, $format = 'H:i:s') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}


switch($category) {
    case 1:
        $img = "images/event_images/music_category.jpg";
        break;
    case 2:
        $img = "images/event_images/nightlife_category.jpg";
        break;
    case 3:
        $img ="images/event_images/culture_category.jpg";
        break;
    case 4:
        $img = "images/event_images/food_category.jpg";
        break;
    case 5:
        $img = "images/event_images/sport_category.jpg";
        break;

    default:
        $img = "";
}

if(!$errors) {
    createEvent( $pdo,$category,$user_id, $title, $organizer, $location,$img, $date, $time, $description, $comments);
    redirection('../event.php?e=13');
}
else {
    $_SESSION['event_errors'] = $errors;
    redirection('../event.php');
}










