<?php
    require_once './config.php';
    require_once './functions.php';

    $name = '';
    $userid = '';

if($_POST['userid'] && $_POST['userUpdateName']){
    $name = $_POST['userUpdateName'];
    $userid = $_POST['userid'];

    if(trim(strlen($name)) >= 3 && !is_numeric($name)) {
        try{
            $sql = "UPDATE users SET `firstname` = :name WHERE id_user = :userid";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e){
            throw new PDOException($e->getMessage());
        } finally {
            redirection('../user_profile.php');
        }
    } else {
        redirection('../user_profile.php?m=41');
    }
} else {
    redirection('../user_profile.php?m=42');
}
