<?php
require_once 'config.php';

$sql = $pdo->prepare("SELECT event_title FROM events");
$sql->execute();
$result = $sql->fetchAll();
exit(json_encode(json_encode($result)));
