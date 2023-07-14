<?php
session_start();
require_once '../../php/config.php';
$event_id = '';
$user_id = '';
$deleteMessage = '';
$admin_id = '';
$eventName = '';
$currDate = '';
$db_eventName = '';
$flag = 0;

if(isset($_POST['id_event']) && isset($_POST['id_user']) && isset($_POST['deleteMessage']) && isset($_SESSION['admin-id']) && isset($_POST['eventNameDel'])) {
    $event_id = $_POST['id_event'];
    $user_id = $_POST['id_user'];
    $deleteMessage = $_POST['deleteMessage'];
    $admin_id = $_SESSION['admin-id'];
    $currDate = date('Y-m-d');
    $eventName = $_POST['eventNameDel'];


    try {
        $sql = "SELECT event_title FROM events WHERE event_id =" . $event_id;
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        $db_eventName = $result['event_title'];
        var_dump($db_eventName);
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }
}

if($eventName === $db_eventName) {
    try {
        $message = "INSERT INTO admin_to_user_msg (admin_id, user_id, message, date_sent, event_name) VALUES ('$admin_id', '$user_id', '$deleteMessage', '$currDate' , '$eventName')";
        $stmt = $pdo->prepare($message);
        $stmt->execute();
        $flag = 1;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }
} else {
    redirection('../admin.php?m=37');
}

if($flag == 1) {
    try {
        $delete = 'DELETE FROM events WHERE event_id=' . $event_id;
        $stmt = $pdo->prepare($delete);
        $stmt->execute();
        redirection('../admin.php?m=30');
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }
}


