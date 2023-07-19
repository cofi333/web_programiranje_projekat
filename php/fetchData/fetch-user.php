<?php
session_start();
require_once '../config.php';

$id_user = '';

if(isset($_SESSION['id_user'])){
    $id_user = $_SESSION['id_user'];
}

$sql = $pdo->prepare("SELECT users.id_user, users.email, users.firstname, users.date_time FROM users WHERE id_user = "  . $id_user . ";");
$sql->execute();
$result = $sql->fetchAll();
exit(json_encode($result));
