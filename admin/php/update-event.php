<?php
session_start();
require_once '../../php/config.php';
$eventID = '';
$userID = '';
$eventName = '';
$eventDescription = '';
$eventLocation = '';
$eventDate = '';
$eventTime = '';
$errors = [];

if(isset($_POST['eventID']) and isset($_POST['eventName']) and isset($_POST['eventDescription']) and isset($_POST['eventLocation']) and isset($_POST['eventDate']) and isset($_POST['eventTime'])){
    $eventID = $_POST['eventID'];
    $eventName = $_POST['eventName'];
    $eventDescription = $_POST['eventDescription'];
    $eventLocation = $_POST['eventLocation'];
    $eventDate = $_POST['eventDate'];
    $eventTime = $_POST['eventTime'];
    $userID = $_POST['userID'];
} else{
    redirection('../admin?m=26');
}

if(empty($eventName) || strlen(trim($eventName, " ")) < 5 || is_numeric($eventName)) {
    $errors[] = "Invalid event name, please enter proper name." . "<br/>";
}

if(empty($eventDescription) || strlen(trim($eventDescription)) < 10 || is_numeric($eventDescription)) {
    $errors[] = "Event description is too short or invalid." . "<br/>";
}

if(empty($eventLocation) || strlen(trim($eventLocation) < 5) || is_numeric($eventLocation)) {
    $errors[] = "Please enter valid event location" . "<br/>";
}

if(empty($eventDate) || !validateDate($eventDate)) {
    $errors[] = "Event date is not valid or its empty" . "<br/>";
}

if(empty($eventTime)) {
    $errors[] = "Please enter proper time for your event" . "<br/>";
}

if(!$errors) {
    try{
        $sql = "UPDATE `events` SET `event_title`='$eventName', `event_location`='$eventLocation', `event_date`='$eventDate',`event_time`='$eventTime',`event_description`='$eventDescription' WHERE event_id = " . $eventID;
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        redirection('../admin.php?m=35');
    }catch (PDOException $e){
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }
} else {
    $_SESSION['errors'] = $errors;
    redirection('../admin.php?m=36');
}

//function to validate date format
function validateDate($date, $format = 'Y-m-d') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}