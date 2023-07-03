<?php
session_start();

$username = '';
$sessionID = '';

if(isset($_SESSION['admin-username']) && $_SESSION['admin-id']){
    $username = $_SESSION['admin-username'];
    $sessionID = $_SESSION['admin-id'];
    echo 'ok';
}