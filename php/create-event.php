<?php
session_start();
require_once 'config.php';
require_once 'functions.php';

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
    redirection('../event.php?e=4');
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

createEvent( $pdo,$category,$user_id, $title, $organizer, $location,$img, $date, $time, $description, $comments);
redirection('../event.php?e=13');










