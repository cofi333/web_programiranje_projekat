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

if(isset($_POST['venue-location'])) {
    $location = $_POST['venue-location'];
}

if(isset($_POST['online-location'])) {
    $location = $_POST['online-location'];
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

createEvent( $pdo,$category,$user_id, $title, $organizer, $location, $date, $time, $description);











