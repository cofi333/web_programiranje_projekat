<?php
require_once 'config.php';
if(isset($_GET['guest_id'])) {
    $guest_id = $_GET['guest_id'];
}

$sql =  $pdo->prepare("DELETE FROM guests WHERE guest_id=" . $guest_id);
$sql->execute();