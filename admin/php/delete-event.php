<?php
session_start();
require_once '../../php/config.php';
$event_id = '';
$user_id = '';
$deleteMessage = '';
$admin_id = '';
$flag = 0;

if(isset($_POST['id_event']) && isset($_POST['id_user']) && isset($_POST['deleteMessage']) && isset($_SESSION['admin-id'])) {
    $event_id = $_POST['id_event'];
    $user_id = $_POST['id_user'];
    $deleteMessage = $_POST['deleteMessage'];
    $admin_id = $_SESSION['admin-id'];
    $flag = 1;
}

//delete query
if($flag == 1){
    try{
        $delete = "DELETE FROM events WHERE event_id =" . $event_id;
        $stmt = $pdo->prepare($delete);
        $stmt->execute();
    }catch (PDOException $e){
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }

    try{
        $message = "INSERT INTO admin_to_user_msg (admin_id, user_id, message) VALUES ('$admin_id', '$user_id', '$deleteMessage')";
        $stmt = $pdo->prepare($message);
        $stmt->execute();
    }catch (PDOException $e){
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    } finally {
        redirection('../admin.php?m=30');
    }
}
else{
    echo 'error';
}

