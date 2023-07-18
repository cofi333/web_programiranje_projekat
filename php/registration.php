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
    redirection('../sign_up.php?r=4');
}


if (empty($password)) {
    redirection('../sign_up.php?r=9');
}

if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)) {
    redirection('../sign_up.php?r=10');
}

if (empty($passwordConfirm)) {
    redirection('../sign_up.php?r=9');
}

if ($password !== $passwordConfirm) {
    redirection('../sign_up.php?r=7');
}

if (empty($email) or !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirection('../sign_up.php?r=8');
}

if (!existsUser($pdo, $email)) {
    $token = createToken(20);
    if ($token) {
        $id_user = registerUser($pdo, $password, $firstname,  $email, $token);
        try {
            $body = "<div style=\"background: radial-gradient(circle, rgb(97, 65, 189) 30%, rgb(28, 19, 55) 100%); padding:15px; text-align:center; color: #fff; font-family: 'Oxygen', sans-serif; height: 100vh; display: flex;flex-direction:column;justify-content: center\">
                        <h1 style=\"padding-top:50px\">ACTIVATE YOUR ACCOUNT</h1>
                        <p style=\"padding: 35px\">Hi, your username is $email. <br>
                        To activate your account click on the button below.</p>
                            <div>
                                <a href=" . SITE . "php/active.php?token=$token style=\"text-decoration:none; color: #fff;border: 1px solid #fff; padding: 5px;\">ACTIVATE</a>
                            </div>
                    </div>";
            sendEmail($pdo, $email, $emailMessages['register'], $body);
            redirection("../sign_up.php?r=3");
        } catch (Exception $e) {
            error_log("****************************************");
            error_log($e->getMessage());
            error_log("file:" . $e->getFile() . " line:" . $e->getLine());
            redirection("../index.php?r=11");
        }
    }
} else {
    redirection('../sign_up.php?r=2');
}
