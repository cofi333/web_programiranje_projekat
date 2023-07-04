<?php
require_once '../../php/functions.php';
session_start();

if(isset($_SESSION['admin-username']) && $_SESSION['admin-id']){
    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();

    redirection("../a-login.php?m=5");
    exit();
} else{
    redirection("../a-login.php?m=0");
    exit();
}
