<?php
session_start();
require_once '../config.php';

$id_user = '';

if(isset($_SESSION['id_user'])){
    $id_user = $_SESSION['id_user'];
}

try{
    $sql = ("SELECT events.event_id, events.event_title, events.event_img, events.is_banned FROM events WHERE events.id_user = " . $id_user);
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    exit(json_encode($result));
} catch(PDOException $e){
    echo 'Error: ' . $e->getMessage();
    throw new \PDOException($e->getMessage());
}