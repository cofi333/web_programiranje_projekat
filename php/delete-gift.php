<?php

require_once 'config.php';
require_once 'functions.php';
if (isset($_GET['wish_id'])) {
    $wish_id = $_GET['wish_id'];
}

if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
}


deleteGiftItem($pdo, $wish_id);

redirection('./wish-list.php?event_id=' . $event_id. "&wl=33");