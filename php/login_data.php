<?php
    require_once './config.php';
    session_start();

    $user_email = '';
    $user_password = '';
    $data = [];

    if(isset($_POST['email']) && isset($_POST['password'])){
        $user_email = $_POST['email'];
        $user_password = $_POST['password'];
        $data = checkUserLogin($pdo, $user_email, $user_password);
    }
    else {
        redirection('../login.php?l=1');
    }

    if($data['is_banned'] === 1) {
        redirection('../login.php?l=23');
    }
    else {
        if($data and is_int($data['id_user'])){
            $_SESSION['username'] = $user_email;
            $_SESSION['id_user'] = $data['id_user'];
            redirection('../index.php');
        }
        else {
            redirection('../index.php?l=1');
        }
    }