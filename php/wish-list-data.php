<?php
session_start();

require_once 'config.php';
require_once 'functions.php';

if(isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];
}

if (isset($_SESSION['id_user'])) {
    $user_id = $_SESSION['id_user'];
}

if(isset($_POST['gift-name'])) {
    $gift_name = $_POST['gift-name'];
}

if(isset($_POST['gift-link'])) {
    $gift_link = $_POST['gift-link'];
}


insertGiftItem($pdo, $user_id, $event_id, $gift_name, $gift_link);
redirection('./wish-list.php?event_id='.$event_id . "&wl=34");