<?php
    session_start();
    require_once '../../php/config.php';


 if(isset($_GET['id_user'])) {
         try{
             $sql = ("UPDATE users SET is_banned = 1 WHERE id_user = " . $_GET['id_user'] . " AND is_banned = 0");
             $stmt = $pdo->prepare($sql);
             $stmt->execute();
             redirection("../admin.php?m=25");
         } catch (PDOException $e){
             echo 'Error: ' . $e->getMessage();
             throw new \PDOException($e->getMessage());
         }
         unset($_SESSION["id_user"]);
     } else {
     redirection("../admin.php?m=26");
 }