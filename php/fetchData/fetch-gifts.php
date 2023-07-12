<?php
session_start();
require_once '../config.php';

if(isset($_SESSION['event_id2'])) {
    $event_id = $_SESSION['event_id2'];
}


$sql = $pdo->prepare("SELECT wish_id,event_id,wish_gift_name, wish_gift_link FROM wish_list WHERE event_id=" .$event_id);
$sql->execute();
$result = $sql->fetchAll();
exit(json_encode($result));
