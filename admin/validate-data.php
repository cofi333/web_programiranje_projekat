<?php
session_start();
require_once '../php/config.php';
$adminUsername = '';
$adminPassword = '';
$dbUsername = '';
$dbPassword = '';
$flag = 0;

if(isset($_POST['email']) && isset($_POST['paswd'])){
    $adminUsername = $_POST['email'];
    $adminPassword = $_POST['paswd'];
    $flag = 1;
}

if($flag == 1){
    try{
        $sql = "SELECT * FROM admins";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_BOTH);
        $dbUsername = $result['username'];
        $dbPassword = $result['password'];
        $dbID = $result['id_admin'];

    }catch (PDOException $e){
        var_dump($e->getCode());
        throw new PDOException($e->getMessage());
    }


    if(password_verify($adminPassword, $dbPassword) && ($adminUsername === $dbUsername)){
        $_SESSION['admin-username'] = $adminUsername;
        $_SESSION['admin-id'] = $dbID;
        redirection('./admin.php');
    } else{
        session_destroy();
        redirection('./a-login.php?m=18');
    }
}


