<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require_once "config.php";

//function to register new user
function registerUser(PDO $pdo, string $password, string $firstname,  string $email, string $token): int
{

    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (password,firstname,email,registration_token,registration_expires,active) 
                        VALUES (:passwordHashed,:firstname,:email,:token,DATE_ADD(now(),INTERVAL 1 DAY),0)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':passwordHashed', $passwordHashed, PDO::PARAM_STR);
    $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    $stmt->execute();

    // http://dev.mysql.com/doc/refman/5.6/en/date-and-time-functions.html

    return $pdo->lastInsertId();

}

//function to check if user exists
function existsUser(PDO $pdo, string $email): bool
{
    $sql = "SELECT id_user FROM users WHERE email=:email AND (registration_expires>now() OR active ='1') LIMIT 0,1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->fetch(PDO::FETCH_ASSOC);

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
    $sql = "SELECT id_user, password FROM users WHERE email=:email AND active=1 AND is_banned = 0 LIMIT 0,1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    $data = [];
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {

        $registeredPassword = $result['password'];

        if (password_verify($enteredPassword, $registeredPassword)) {
            $data['id_user'] = $result['id_user'];
        }
    }

    return $data;
}

function createEvent(PDO $pdo, $category,$user_id, $title, $organizer, $location, $img, $date, $time, $description) : void
{
<<<<<<< HEAD
    $sql = "INSERT INTO events (ec_id,id_user, event_title, event_organizer,event_location, event_img , event_date, event_time, event_description)
    VALUES (:category,:id_user ,:title, :organizer, :location, :img , :date, :time, :description)";
=======
    $sql = "INSERT INTO events (ec_id,id_user, event_title, event_organizer,event_location, event_date, event_time, event_description)
                        VALUES (:category,:id_user ,:title, :organizer, :location, :date, :time, :description)";
>>>>>>> 1e1c994901ddba60bcd24b9a135b194d5a76d544


    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    $stmt->bindParam(':id_user', $user_id, PDO::PARAM_STR);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':organizer', $organizer, PDO::PARAM_STR);
    $stmt->bindParam(':location', $location, PDO::PARAM_STR);
    $stmt->bindParam(':img', $img, PDO::PARAM_STR);
    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
    $stmt->bindParam(':time', $time, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->execute();
}
