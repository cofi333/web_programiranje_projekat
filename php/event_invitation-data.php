<?php
require_once 'config.php';

if (isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];
}
if (isset($_POST['guest_id'])) {
    $guest_id = $_POST['guest_id'];
}

try {
    $sql = "SELECT guest_id, event_id, comment_sent FROM guests WHERE event_id=".$event_id . " AND guest_id=" . $guest_id;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
    var_dump($e->getCode());
    throw new \PDOException($e->getMessage());
}


if(isset($_POST['flexRadioDefault'])) {
    $is_coming = $_POST['flexRadioDefault'];
        guestUpdateRespone($pdo, $event_id, $guest_id, $is_coming);
        redirection('./event_invitation.php?ei=22&event_id='. $event_id . '&guest_id=' .$guest_id);
}


if(isset($_POST['guest-comment'])) {
    $comment = $_POST['guest-comment'];

    if($result['comment_sent'] == 0) {

        insertComment($pdo, $event_id, $guest_id, $comment);

        try {
            $sql = "UPDATE guests SET comment_sent = 1 WHERE event_id=" . $event_id . " AND guest_id=" . $guest_id;
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        } catch (PDOException $e) {
            var_dump($e->getCode());
            throw new \PDOException($e->getMessage());
        }

        redirection('./event_invitation.php?&event_id='. $event_id. '&guest_id=' .$guest_id);

    }
    else {
        redirection('./event_invitation.php?ei=20&event_id='. $event_id. '&guest_id=' .$guest_id);
    }

}



