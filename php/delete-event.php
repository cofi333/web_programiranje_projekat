<?php
<<<<<<< HEAD
=======
require_once 'config.php';
if(isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
}

$sql =  $pdo->prepare("DELETE FROM events WHERE event_id=" . $event_id);
$sql->execute();

redirection('../user_profile.php?up=17');
>>>>>>> 5f91b6c05fb351c64f056cfc80f5a8bcb9746337
