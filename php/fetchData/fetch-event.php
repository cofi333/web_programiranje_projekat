<?php
require_once '../config.php';

$sql = $pdo->prepare("SELECT events.event_id, events.event_img, events.event_title, events.event_date, events.event_time, events.event_description, event_category.category FROM events INNER JOIN event_category ON events.ec_id = event_category.ec_id;");
$sql->execute();
$result = $sql->fetchAll();
exit(json_encode($result));
