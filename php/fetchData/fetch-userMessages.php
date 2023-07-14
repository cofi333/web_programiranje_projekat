<?php
session_start();
require_once '../config.php';

$id_user = '';

if(isset($_SESSION['id_user'])){
    $id_user = $_SESSION['id_user'];
}

try{
    $sql = "SELECT message, date_sent, event_name FROM admin_to_user_msg WHERE user_id = " . $id_user;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    exit(json_encode($result));
} catch (PDOException $e){
    echo 'Error: ' . $e->getMessage();
    throw new \PDOException($e->getMessage());
}