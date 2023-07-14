<?php
session_start();
require_once './functions.php';
require_once './config.php';

$errors = [];

if (isset($_SESSION['id_user'])) {
    $user_id = $_SESSION['id_user'];
}

if (isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];
}

if(isset($_POST['guest-email'])) {
    $guest_email = $_POST['guest-email'];
}

if(isset($_POST['guest-name'])) {
    $guest_name = $_POST['guest-name'];
}

if(empty($guest_email) || empty($guest_name)) {
    $errors[] = "Fields can't be empty.";
}

if(!filter_var($guest_email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email is not in valid form.";
}

if(trim(strlen($guest_name)) < 3) {
    $errors[] = "Name must have at least 3 characters.";
}


if(!$errors) {
    if(is_numeric(getGuestId($pdo, $guest_email, $event_id))) {
        redirection('./send-invitation.php?si=19&event_id='.$event_id);
    }
    else {
        $token = createToken(20);
        insertGuest($pdo,$event_id,$user_id, $guest_email, $guest_name, $token);

        $result = getGuestId($pdo,$guest_email, $event_id);

        try {
            $body = "<div style=\"background: radial-gradient(circle, rgb(97, 65, 189) 30%, rgb(28, 19, 55) 100%); padding:15px; text-align:center; color: #fff; font-family: 'Oxygen', sans-serif; height: 100vh; display: flex;flex-direction:column;justify-content: center\">
    <h1 style=\"padding-top:50px\">YOU ARE INVITED TO THE EVENT</h1>
    <p style=\"padding: 35px\">Hi, you are invited from organizer to come on event. <br>
        Click on button below to get more information about event and let the organizer know if you are coming to the event.</p>
  <div>
         <a href=" . SITE . "php/event_invitation.php?event_id=".$event_id."&guest_id=".$result."&token=".$token." style=\"text-decoration:none; color: #fff;border: 1px solid #fff; padding: 5px;\">ANSWER</a>
  </div>
</div>";
            sendEmail($pdo, $guest_email, $emailMessages['invitation'], $body);
            redirection("./send-invitation.php?si=31&event_id=".$event_id);
        } catch (Exception $e) {
            error_log("****************************************");
            error_log($e->getMessage());
            error_log("file:" . $e->getFile() . " line:" . $e->getLine());
            redirection("../user_profile.php?i=2");
        }
    }
}
else {
    $_SESSION['invitation_errors'] = $errors;
    redirection('./send-invitation.php?event_id='. $event_id);
}






