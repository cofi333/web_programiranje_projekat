<?php
require_once '../../php/config.php';


if(isset($_GET['id_user'])) {
    try{
        $sql = ("UPDATE users SET is_banned = 0 WHERE id_user = " . $_GET['id_user'] . " AND is_banned = 1");
        $stmt = $pdo->prepare($sql);
        $bool = $stmt->execute();
        redirection("../admin.php?m=26");
    } catch (PDOException $e){
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }
} else {
    redirection("../admin.php?m=25");
}
