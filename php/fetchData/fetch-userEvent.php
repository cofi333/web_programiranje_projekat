<?php
session_start();
require_once '../config.php';

$id_user = '';

if(isset($_SESSION['id_user'])){
    $id_user = $_SESSION['id_user'];
}

$sql = ("SELECT events.event_id, events.event_title, events.event_img FROM events WHERE events.id_user = " . $id_user);
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
exit(json_encode($result));