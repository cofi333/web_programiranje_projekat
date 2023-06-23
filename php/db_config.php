<?php
//const HOST = "localhost";
//const USER = "programatori";
//const PASSWORD = "4sqwbd4SfhJhvCL";
//const DB = "programatori";
//const CHARSET = "utf8mb4";

const HOST = "localhost";
const USER = "root";
const PASSWORD = "";
const DB = "programatori";
const CHARSET = "utf8mb4";

$pdoOptions = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];


$dsn = "mysql:host=" . HOST  . ";dbname=" . DB . ";charset=". CHARSET;

function connectDatabase(string $dsn, array $pdoOptions): PDO
{

    try {
        $pdo = new PDO($dsn, USER, PASSWORD , $pdoOptions);

    } catch (\PDOException $e) {
        var_dump($e->getCode());
        throw new \PDOException($e->getMessage());
    }

    return $pdo;
}
