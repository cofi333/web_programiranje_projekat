<?php
require_once 'config.php';
require_once 'functions.php';

if(isset($_POST['gift-new-name'])) {
    $new_gift_name = $_POST['gift-new-name'];
}

if(isset($_POST['gift-new-link'])) {
    $new_gift_link = $_POST['gift-new-link'];
}

if(isset($_POST['event-id'])) {
    $event_id = $_POST['event-id'];
}

if(isset($_POST['wish-id'])) {
    $wish_id = $_POST['wish-id'];
}

updateGiftItem($pdo, $wish_id ,$new_gift_name, $new_gift_link);
redirection('./wish-list.php?event_id='.$event_id ."&wl=32");
