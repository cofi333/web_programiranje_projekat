<?php
try{
    $sql = "SELECT * FROM admins";
    $stmt = $pdo->prepare($sql);
    $stmt -> execute();
    $result = $stmt->fetchAll();
    exit(json_encode($result));
} catch (PDOException $e){
    throw new PDOException($e->getMessage());
}
