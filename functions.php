<?php

require_once ('./vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function findUserByEmail ($email) {
    global $db;
    $stmt =$db->prepare("select * from user where email = ?");
    $stmt->execute(array($email));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function findUserById ($id) {
    global $db;
    $stmt = $db->prepare("select * from user where id = ?");
    $stmt->execute(array($id));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function detetPage(){
    $uri = $_SERVER['REQUEST_URI'];
    $parts = explode('/', $uri);
    $fileName = $parts[count($parts)-1];
    $parts = explode('.', $fileName);
    $page = $parts[0];
    return $page;
}
function updateUserPassword($id, $password){
    global $db;
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $db->prepare("UPDATE user SET password = ? Where id = ?");
    return $stmt->execute(array($hashPassword, $id));
}
function createUser($firstName, $surname, $displayName, $gender, $email, $password, $DOB, $phoneNumber){
    global $db, $BASE_URL;
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    $code = generateRandomString(16);
    $stmt = $db->prepare("INSERT INTO `user` (`id`, `firstName`, `surname`, `displayName`, `gender`, `email`, `password`, `DOB`, `phoneNumber`, `status`, `code`, `mime`, `avatars`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, NULL, NULL);");
    $stmt->execute(array($firstName, $surname, $displayName, $gender, $email, $hashPassword, $DOB, $phoneNumber, $code));
    $id = $db->lastInsertId();
    sendEmail($email, $displayName, 'Kích hoạt tài khoản', "Để kích hoạt tài khoản vui lòng ấn vào đường link: <a href = \"$BASE_URL/activate.php?code=$code&&email=$email\">$BASE_URL/activate.php?code=$code&&email=$email</a>");
    return $id;
}
function updateProfile($displayName, $DOB, $phoneNumber, $mime, $avatars, $id){
    global $db;
    $stmt = $db->prepare("UPDATE `user` SET `displayName` = ?, `DOB` = ?, `phoneNumber` = ?, `mime` = ?, `avatars` =  ? WHERE `user`.`id` = ?");
    return $stmt->execute(array($displayName, $DOB, $phoneNumber, $mime, $avatars, $id));
}
function getNewFeeds(){
    global $db;
    $stmt = $db->query("SELECT p.*, u.displayName, u.id FROM posts AS p JOIN user AS u ON p.userID = u.id ORDER BY createdAt DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getMyStatus($userID){
    global $db;
    $stmt = $db->prepare("SELECT p.*, u.displayName, u.id, u.DOB  FROM posts AS p JOIN user AS u ON p.userID = u.id Where u.id = ? ORDER BY createdAt DESC");
    $stmt->execute(array($userID));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function createPost($userID, $content){
    global $db;
    $stmt = $db->prepare("INSERT INTO posts (content, userID) VALUES (? ,? )");
    $stmt->execute(array($content, $userID));
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function sendEmail($to, $name, $subject, $content){

    global $EMAIL_FROM, $EMAIL_PASSWORD, $EMAIL_NAME;

    $mail = new PHPMailer(true);

    //Server settings                
    $mail->isSMTP();
    $mail->CharSet    = 'UTF-8';
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = $EMAIL_FROM;                   
    $mail->Password   = $EMAIL_PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom($EMAIL_FROM, $EMAIL_NAME);
    $mail->addAddress($to, $name); 

    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $content;
    //$mail->AltBody = $content;

    $mail->send();
}
function activateUser($code){
    global $db;
    $stmt =$db->prepare("select * from user where code = ? and status = ?");
    $stmt->execute(array($code, '0'));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && $user['code'] == $code){
        $stmt = $db->prepare("UPDATE user SET code = ?, status = ? Where id = ?");
        $stmt->execute(array('', '1', $user['id']));
        return true;
    }
    return false;
}
function crateCodeForgetPassword($code, $email){
    global $db;
    $stmt = $db->prepare("UPDATE `user` SET `code` = ? WHERE`user`.`email` = ?");
    return $stmt->execute(array($code, $email));
}
function activatePassword($code){
    global $db;
    $stmt =$db->prepare("select * from user where code = ?");
    $stmt->execute(array($code));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && $user['code'] == $code){
        $stmt = $db->prepare("UPDATE user SET code = ? Where id = ?");
        $stmt->execute(array('', $user['id']));
        return true;
    }
    return false;
}
function loadAvatars($id){
    global $db;
    $stmt =$db->prepare("select * from user where id = ?");
    $stmt->execute(array($id));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}