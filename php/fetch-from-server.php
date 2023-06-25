<?php
require_once 'config.php';

$sql = $pdo->prepare("SELECT event_title FROM events");
$sql->execute();
$result = $sql->fetchAll();
$jsonResult = json_encode($result);
print_r($jsonResult);