<?php
require_once 'config.php';

if (isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];
}
if (isset($_POST['guest_id'])) {
    $guest_id = $_POST['guest_id'];
}

try {
    $sql = "SELECT guest_id, event_id, comment_sent FROM guest_event WHERE event_id=".$event_id;
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

    if($result) {
        guestUpdateRespone($pdo, $event_id, $guest_id, $is_coming);
        echo "your response is updated.";
    }
    else {
        guestResponse($pdo, $event_id, $guest_id, $is_coming);
        echo "your response is inserted.";
    }
}


if(isset($_POST['guest-comment'])) {
    $comment = $_POST['guest-comment'];

    if($result['comment_sent'] == 0) {

        insertComment($pdo, $event_id, $guest_id, $comment);

        try {
            $sql = "UPDATE guest_event SET comment_sent = 1 WHERE event_id=" . $event_id . " AND guest_id=" . $guest_id;
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        } catch (PDOException $e) {
            var_dump($e->getCode());
            throw new \PDOException($e->getMessage());
        }

        redirection('../index.php');

    }
    else {
        echo 'you already sent comment';
    }

}



