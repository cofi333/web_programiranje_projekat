<?php
session_start();
require_once '../config.php';

$id_user = '';

if(isset($_SESSION['id_user'])){
    $id_user = $_SESSION['id_user'];
    //session_destroy();
}

$sql = "SELECT email, firstname, date_time FROM users WHERE id_user = "  . $id_user;
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
exit(json_encode($result));
