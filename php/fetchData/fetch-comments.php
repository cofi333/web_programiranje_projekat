<?php
require_once '../config.php';
session_start();

if(isset($_SESSION['event_id'])) {
    $event_id = $_SESSION['event_id'];
}

$sql = "SELECT comments.comment, guests.guest_name FROM comments INNER JOIN guests ON comments.guest_id = guests.guest_id WHERE comments.event_id =".$event_id;
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
exit(json_encode($result));