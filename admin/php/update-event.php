<?php
require_once '../../php/config.php';
$eventID = '';
$userID = '';
$eventName = '';
$eventDescription = '';
$eventLocation = '';
$eventDate = '';
$eventTime = '';

if(isset($_POST['eventID']) and isset($_POST['eventName']) and isset($_POST['eventDescription']) and isset($_POST['eventLocation']) and isset($_POST['eventDate']) and isset($_POST['eventTime'])){
    $eventID = $_POST['eventID'];
    $eventName = $_POST['eventName'];
    $eventDescription = $_POST['eventDescription'];
    $eventLocation = $_POST['eventLocation'];
    $eventDate = $_POST['eventDate'];
    $eventTime = $_POST['eventTime'];
    $userID = $_POST['userID'];

    try{
        $sql = "UPDATE `events` SET `event_title`='$eventName', `event_location`='$eventLocation', `event_date`='$eventDate',`event_time`='$eventTime',`event_description`='$eventDescription' WHERE event_id = " . $eventID;
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        redirection('../admin.php?m=31');
    }catch (PDOException $e){
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }
} else{
    redirection('../admin?m=26');
}