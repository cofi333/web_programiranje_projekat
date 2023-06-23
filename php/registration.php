<?php

require_once 'functions.php';

if (isset($_POST['name'])) {
    $firstname = trim($_POST["name"]);
}

if (isset($_POST['email'])) {
    $email = trim($_POST["email"]);
}

if (isset($_POST['password'])) {
    $password = trim($_POST["password"]);
}

if (isset($_POST['repeat-password'])) {
    $passwordConfirm = trim($_POST["repeat-password"]);
}



if (empty($firstname)) {
    redirection('../index.php?r=4');
}


if (empty($password)) {
    redirection('../index.php?r=9');
}

if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)) {
    redirection('../index.php?r=10');
}

if (empty($passwordConfirm)) {
    redirection('../index.php?r=9');
}

if ($password !== $passwordConfirm) {
    redirection('../index.php?r=7');
}

if (empty($email) or !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirection('../index.php?r=8');
}


if (!existsUser($pdo, $email)) {
    $token = createToken(20);
    if ($token) {
        $id_user = registerUser($pdo, $password, $firstname,  $email, $token);
        try {
            $body = "Your username is $email. To activate your account click on the <a href=" . SITE . "active.php?token=$token>link</a>";
            sendEmail($pdo, $email, $emailMessages['register'], $body, $id_user);
            redirection("index.php?r=3");
        } catch (Exception $e) {
            error_log("****************************************");
            error_log($e->getMessage());
            error_log("file:" . $e->getFile() . " line:" . $e->getLine());
            redirection("../index.php?r=11");
        }
    }
} else {
    redirection('../index.php?r=2');
}
