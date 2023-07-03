<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require_once "config.php";

//function to register new user
function registerUser(PDO $pdo, string $password, string $firstname,  string $email, string $token): int
{

    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO users (password,firstname,email,registration_token,registration_expires,active) 
                        VALUES (:passwordHashed,:firstname,:email,:token,DATE_ADD(now(),INTERVAL 1 DAY),0)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':passwordHashed', $passwordHashed, PDO::PARAM_STR);
        $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->execute();

        return $pdo->lastInsertId();

    }
    catch (PDOException $e) {
        var_dump($e->getCode());
        throw new \PDOException($e->getMessage());
    }
}

//function to check if user exists
function existsUser(PDO $pdo, string $email): bool
{
    try {
        $sql = "SELECT id_user FROM users WHERE email=:email AND (registration_expires>now() OR active ='1') LIMIT 0,1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->fetch(PDO::FETCH_ASSOC);

    }
    catch(PDOException $e) {
        var_dump($e->getCode());
        throw new \PDOException($e->getMessage());
    }

    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

//fucntion to create token for user
function createToken(int $length): ?string
{
    try {
        return bin2hex(random_bytes($length));
    } catch (\Exception $e) {
        // c:xampp/apache/logs/
        error_log("****************************************");
        error_log($e->getMessage());
        error_log("file:" . $e->getFile() . " line:" . $e->getLine());
        return null;
    }
}

//function to redirect user
function redirection($url)
{
    header("Location:$url");
    exit();
}

//function to connect to database
function connectDatabase(string $dsn, array $pdoOptions): PDO
{

    try {
        $pdo = new PDO($dsn, USER, PASSWORD , $pdoOptions);

    } catch (PDOException $e) {
        var_dump($e->getCode());
        throw new \PDOException($e->getMessage());
    }

    return $pdo;
}

//function to send mail via mailtrap
function sendEmail(PDO $pdo, string $email, array $emailData, string $body): void
{

    $phpmailer = new PHPMailer(true);

    try {

        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = '91a70046fbb2a2';
        $phpmailer->Password = '27338e9f68a475';


        $phpmailer->setFrom('webmaster@example.com', 'Webmaster');
        $phpmailer->addAddress("$email");

        $phpmailer->isHTML(true);
        $phpmailer->Subject = $emailData['subject'];
        $phpmailer->Body = $body;
        $phpmailer->AltBody = $emailData['altBody'];

        $phpmailer->send();

    } catch (Exception $e) {
        $message = "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
    }

}

function checkUserLogin(PDO $pdo, string $email, string $enteredPassword): array
{
    try {
        $sql = "SELECT id_user, password FROM users WHERE email=:email AND active=1 AND is_banned = 0 LIMIT 0,1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        $data = [];
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e) {
        var_dump($e->getCode());
        throw new \PDOException($e->getMessage());
    }

    if ($stmt->rowCount() > 0) {

        $registeredPassword = $result['password'];

        if (password_verify($enteredPassword, $registeredPassword)) {
            $data['id_user'] = $result['id_user'];
        }
    }

    return $data;
}

function createEvent(PDO $pdo,int $category, int $user_id, string $title, string $organizer, string $location,string $img, string $date, string $time, string $description) : void
{
    try {
        $sql = "INSERT INTO events (ec_id,id_user, event_title, event_organizer,event_location, event_img , event_date, event_time, event_description)
    VALUES (:category,:id_user ,:title, :organizer, :location, :img , :date, :time, :description)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':category', $category, PDO::PARAM_INT);
        $stmt->bindParam(':id_user', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':organizer', $organizer, PDO::PARAM_STR);
        $stmt->bindParam(':location', $location, PDO::PARAM_STR);
        $stmt->bindParam(':img', $img, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':time', $time, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->execute();
    }
    catch (PDOException $e) {
        var_dump($e->getCode());
        throw new \PDOException($e->getMessage());
    }

}

function updateEvent(PDO $pdo,int $event_id,int $category, string $title, string $organizer, string $location, string $date, string $time, string $description) : void
{
    try {
        $sql = "UPDATE events SET ec_id= :category,  event_title= :title, event_organizer= :organizer, event_location= :location, event_date= :date, event_time = :time, event_description= :description WHERE event_id = :event_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':category', $category, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':organizer', $organizer, PDO::PARAM_STR);
        $stmt->bindParam(':location', $location, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':time', $time, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->execute();
    }
    catch (PDOException $e) {
        var_dump($e->getCode());
        throw new \PDOException($e->getMessage());
    }
}

function setForgottenToken(PDO $pdo, string $email, string $token): void
{
    try {
        $sql = "UPDATE users SET forgotten_password_token = :token, forgotten_password_expires = DATE_ADD(now(),INTERVAL 6 HOUR) WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
    }
    catch(PDOException $e) {
        var_dump($e->getCode());
        throw new \PDOException($e->getMessage());
    }
}

function getUserData(PDO $pdo, string $data, string $field, string $value): string
{
    try {
        $sql = "SELECT $data as data FROM users WHERE $field=:value LIMIT 0,1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':value', $value, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $data = '';
    }
    catch (PDOException $e) {
        var_dump($e->getCode());
        throw new \PDOException($e->getMessage());
    }

    if ($stmt->rowCount() > 0) {
        $data = $result['data'];
    }

    return $data;
}

function insertGuest (PDO $pdo, int $event_id ,int $id_user,string $email, string $name) : void
{
    try {
        $sql = "INSERT INTO guests (event_id,id_user,guest_mail,guest_name) VALUES (:event_id,:id_user,:mail, :name)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':mail', $email, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
    }
    catch(PDOException $e) {
        var_dump($e->getCode());
        throw new \PDOException($e->getMessage());
    }
}

function guestResponse (PDO $pdo, int $event_id, int $guest_id, int $is_coming ): void {
     try {
         $sql = "INSERT INTO guest_event(event_id,guest_id,is_coming) VALUES (:event_id, :id_guest, :is_coming)";
         $stmt = $pdo->prepare($sql);
         $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
         $stmt->bindParam(':id_guest', $guest_id, PDO::PARAM_INT);
         $stmt->bindParam(':is_coming', $is_coming, PDO::PARAM_INT);
         $stmt->execute();
     }
     catch (PDOException $e) {
         var_dump($e->getCode());
         throw new \PDOException($e->getMessage());

     }
}

function guestUpdateRespone (PDO $pdo, int $event_id, int $guest_id, int $is_coming): void {
    try {
        $sql = "UPDATE guest_event SET is_coming=:is_coming WHERE event_id=:event_id AND guest_id=:guest_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam('is_coming', $is_coming, PDO::PARAM_INT);
        $stmt->bindParam('event_id', $event_id, PDO::PARAM_INT);
        $stmt->bindParam('guest_id', $guest_id, PDO::PARAM_INT);
        $stmt->execute();
    }
    catch (PDOException $e){
        var_dump($e->getCode());
        throw new \PDOException($e->getMessage());
    }
}

function insertComment(PDO $pdo, int $event_id, int $guest_id, string $comment): void {
    try {
        $sql = "INSERT INTO comments (event_id,guest_id,comment,date) VALUES (:event_id, :guest_id, :comment, DATE_ADD(now(),INTERVAL 1 DAY))";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->bindParam(':guest_id', $guest_id, PDO::PARAM_INT);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
        $stmt->execute();
    }
    catch(PDOException $e) {
        var_dump($e->getCode());
        throw new \PDOException($e->getMessage());
    }
}