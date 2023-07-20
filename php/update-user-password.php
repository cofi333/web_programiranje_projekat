<?php
    require_once 'config.php';
    require_once 'functions.php';

    $userID = '';
    $currentPassword = '';
    $newPassword = '';
    $repeatedPassword = '';
    $db_password = '';
    $strongPassword = 0;
    $h_pswd = '';

if(isset($_POST['currentPassword']) && isset($_POST['newPassword']) && isset($_POST['repeatedNewPassword']) && isset($_POST['userid'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $repeatedPassword = $_POST['repeatedNewPassword'];
    $userID = $_POST['userid'];

} else {
    redirection('../user_profile.php?m=43');
}

//fetching user password from database
try{
    $sql = "SELECT password FROM users WHERE id_user=1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $db_password = $result[0]['password'];
} catch (PDOException $e) {
    throw new PDOException($e->getMessage());
}

//new password validation will occur only if current passwords match (user - input:db - record)
if(password_verify($currentPassword, $db_password) && !empty($currentPassword)){
    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $newPassword);
    $lowercase = preg_match('@[a-z]@', $newPassword);
    $number    = preg_match('@[0-9]@', $newPassword);
    $specialChars = preg_match('@[^\w]@', $newPassword);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || trim(strlen($newPassword)) < 8) {
        redirection('../user_profile.php?m=10');
    } else {
        $strongPassword = 1;
    }

    if(($newPassword === $repeatedPassword) && $strongPassword == 1) {
        $h_pswd = password_hash($repeatedPassword, PASSWORD_DEFAULT);
        try{
            $sql = "UPDATE users SET password = :hpswd WHERE id_user = :iduser";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':hpswd', $h_pswd, PDO::PARAM_STR);
            $stmt->bindParam(':iduser', $userID, PDO::PARAM_INT);
            $stmt->execute();
            redirection('../user_profile.php?m=45');
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    } else{
        redirection('../user_profile.php?m=44');
    }
} else {
    redirection('../user_profile.php?m=46');
}