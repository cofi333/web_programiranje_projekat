<?php
require_once 'functions.php';
require_once 'config.php';

$email = trim($_POST["email-forgot"]);
if (!empty($email) and getUserData($pdo, 'id_user', 'email', $email)) {
    $token = createToken(20);
    if ($token) {
        setForgottenToken($pdo, $email, $token);
        $id_user = getUserData($pdo, 'id_user', 'email', $email);
        try {
            $body = "To start the process of changing password, visit <a href=" . SITE . "forget.php?token=$token>link</a>.";
            sendEmail($pdo, $email, $emailMessages['forget'], $body);
            redirection('../sign_up.php?f=14');
        } catch (Exception $e) {
            error_log("****************************************");
            error_log($e->getMessage());
            error_log("file:" . $e->getFile() . " line:" . $e->getLine());
            redirection("../sign_up.php?f=11");
        }
    } else {
        redirection('../sign_up.php?f=14');
    }
} else {
    redirection('../sign_up.php?f=13');
}