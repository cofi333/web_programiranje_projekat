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
        echo 'Error: ' . $e->getMessage();
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
        echo 'Error: ' . $e->getMessage();
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
        echo 'Error: ' . $e->getMessage();
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
        $phpmailer->Username = '8c6d011cccd20c';
        $phpmailer->Password = '8f50cb350ba3d2';

        $phpmailer->setFrom('webmaster@example.com', 'Webmaster');
        $phpmailer->addAddress("$email");

        $phpmailer->isHTML(true);
        $phpmailer->Subject = $emailData['subject'];
        $phpmailer->Body = $body;
        $phpmailer->AltBody = $emailData['altBody'];

        $phpmailer->send();

    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
        $message = "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
    }

}

//function to check user data on log in event
function checkUserLogin(PDO $pdo, string $email, string $enteredPassword): array
{
    try {
        $sql = "SELECT id_user, password, is_banned FROM users WHERE email=:email AND active=1 LIMIT 0,1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        $data = [];
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $data['is_banned'] = $result['is_banned'];
    }
    catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
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

function createEvent(PDO $pdo,int $category, int $user_id, string $title, string $organizer, string $location,string $img, string $date, string $time, string $description, string $comments) : void
{
    try {
        $sql = "INSERT INTO events (ec_id,id_user, event_title, event_organizer,event_location, event_img , event_date, event_time, event_description, event_comments)
                VALUES (:category,:id_user ,:title, :organizer, :location, :img , :date, :time, :description, :comments)";

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
        $stmt->bindParam(':comments', $comments, PDO::PARAM_STR);
        $stmt->execute();
    }
    catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }

}


function updateEvent(PDO $pdo,int $event_id,int $category, string $title, string $organizer, string $location, string $date, string $time, string $description, string $comments) : void
{
    try {
        $sql = "UPDATE events SET ec_id= :category,  event_title= :title, event_organizer= :organizer, event_location= :location, event_date= :date, event_time = :time, event_description= :description, event_comments= :comments WHERE event_id = :event_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':category', $category, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':organizer', $organizer, PDO::PARAM_STR);
        $stmt->bindParam(':location', $location, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':time', $time, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':comments', $comments, PDO::PARAM_STR);
        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->execute();
    }
    catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }
}

//funtion that sends token on forgot-password event
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
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }
}

//funtion that select user based on email address
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
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }

    if ($stmt->rowCount() > 0) {
        $data = $result['data'];
    }

    return $data;
}

//function that stores guest info into guests table
function insertGuest (PDO $pdo, int $event_id ,int $id_user,string $email, string $name, string $token) : void
{
    try {
        $sql = "INSERT INTO guests (event_id, id_user, guest_mail, guest_name, guest_token) VALUES (:event_id,:id_user,:mail, :name, :token)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':mail', $email, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->execute();
    }
    catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }
}



//function for updating guest response on event (is coming, not coming)
function guestUpdateRespone (PDO $pdo, int $event_id, int $guest_id, int $is_coming, mixed $wish_id): void {
    try {
        $sql = "UPDATE guests SET is_coming=:is_coming, wish_id=:wish_id WHERE event_id=:event_id AND guest_id=:guest_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam('is_coming', $is_coming, PDO::PARAM_INT);
        $stmt->bindParam('event_id', $event_id, PDO::PARAM_INT);
        $stmt->bindParam('guest_id', $guest_id, PDO::PARAM_INT);
        $stmt->bindParam('wish_id', $wish_id, PDO::PARAM_STR);
        $stmt->execute();
    }
    catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
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
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }
}

function getGuestId (PDO $pdo, string $mail, int $event_id) : mixed  {
    try {
        $sql ="SELECT guest_id FROM guests WHERE guest_mail=:mail AND event_id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
        $stmt->bindParam(':id', $event_id, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
    }
    catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }

    return $result['guest_id'];
}

function deleteGuest(PDO $pdo, int $guest_id) : void {
    try {
        $sql = "DELETE FROM guests WHERE guest_id=:guest_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':guest_id', $guest_id, PDO::PARAM_INT);
        $stmt->execute();
    }
    catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }
}

function updateGuestInfo(PDO $pdo, int $guest_id ,string $name): void {
    try {
        $sql = "UPDATE guests SET guest_name=:name WHERE guest_id=:guest_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':guest_id', $guest_id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
    }
    catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }

}

function insertGiftItem(PDO $pdo, int $user_id, int $event_id, string $gift_name, string $gift_link) : void {
    try {
        $sql = "INSERT INTO wish_list (id_user,event_id,wish_gift_name,wish_gift_link) VALUES (:user_id,:event_id,:gift_name,:gift_link)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->bindParam(':gift_name', $gift_name, PDO::PARAM_STR);
        $stmt->bindParam(':gift_link', $gift_link, PDO::PARAM_STR);
        $stmt->execute();
    }
    catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }
}

function deleteGiftItem(PDO $pdo, int $wish_id) : void {
    try {
        $sql = "DELETE FROM wish_list WHERE wish_id=:wish_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':wish_id', $wish_id, PDO::PARAM_INT);
        $stmt->execute();
    }
    catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }
}

function updateGiftItem(PDO $pdo,int $wish_id, string $name, string $link) : void {
    try {
        $sql = "UPDATE wish_list SET wish_gift_name=:name, wish_gift_link=:link WHERE wish_id=:wish_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':link', $link, PDO::PARAM_STR);
        $stmt->bindParam(':wish_id', $wish_id, PDO::PARAM_INT);
        $stmt->execute();
    }
    catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }
}

//Fetch comment_sent to check if user already sent comment for event
function getGuestCommentInfo(PDO $pdo, int $event_id, int $guest_id) : int {
    try {
        $sql = "SELECT comment_sent FROM guests WHERE event_id=:event_id AND guest_id=:guest_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->bindParam(':guest_id', $guest_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['comment_sent'];
    }
    catch(PDOException $e) {
        var_dump($e->getCode());
        throw new \PDOException($e->getMessage());
    }
}

//Disable option for guest to comment again
function updateGuestComment(PDO $pdo, int $event_id, int $guest_id) : void {
    try {
        $sql = "UPDATE guests SET comment_sent = 1 WHERE event_id=:event_id AND guest_id=:guest_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->bindParam(':guest_id', $guest_id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        var_dump($e->getCode());
        throw new \PDOException($e->getMessage());
    }
}

