<?php

require_once '../../php/config.php';
$eventID = '';

if(isset($_GET['id_event'])){
    $eventID = $_GET['id_event'];
    try{
        $sql = "UPDATE events SET is_banned = 0 WHERE event_id = " . $eventID;
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        redirection("../admin.php?m=29");
    }catch (PDOException $e){
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }
}
else{
    redirection('../admin.php?m=26');
}
