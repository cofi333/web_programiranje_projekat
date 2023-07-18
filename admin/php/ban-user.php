<?php
    session_start();
    require_once '../../php/config.php';
    $selectedUser = '';


 if(isset($_GET['id_user'])) {
     $selectedUser = $_GET['id_user'];
     if(isset($_SESSION['id_user']) and ($_SESSION['id_user'] === $selectedUser)){
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
     } else{
         echo 'something wrong with if';
         var_dump('session id -> ' . $_SESSION['id_user']);
         var_dump('<br/>' . 'get id -> ' . $selectedUser);
     }
 } else {
     redirection("../admin.php?m=26");
 }