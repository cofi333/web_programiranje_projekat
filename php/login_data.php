<?php
session_start();
require_once './config.php';

$email = trim($_POST["email"]);
$password = trim($_POST["password"]);

if(!empty($email) and !empty($password)){
    $data =checkUserLogin($pdo, $email, $password);

    if ($data and is_int($data['id_user'])) {
        $_SESSION['username'] = $email;
        $_SESSION['id_user'] = $data['id_user'];
        redirection('../user_main.php');
    } else {
        redirection('../login.php?l=1');
    }
} else {
    redirection('../login.php?l=1');
}

