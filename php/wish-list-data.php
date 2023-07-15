<?php
session_start();

require_once 'config.php';
require_once 'functions.php';

$errors = [];

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

if(empty($gift_name) || empty($gift_link)) {
    $errors[] = "Fields can't be empty.";
}

if(trim(strlen($gift_name) < 3)) {
    $errors[] = "Name must have at least 3 characters.";
}

if(trim(strlen($gift_name)) > 30) {
    $errors[] = "Name must have maximum 30 characters.";
}

if(!filter_var($gift_link, FILTER_VALIDATE_URL)) {
    $errors[] = "Link is not in valid form.";
}

if(!$errors) {
    insertGiftItem($pdo, $user_id, $event_id, $gift_name, $gift_link);
    redirection('./wish-list.php?event_id='.$event_id . "&wl=34");
}
else {
    $_SESSION['wish_list_errors'] = $errors;
    redirection('./wish-list.php?event_id='.$event_id);
}