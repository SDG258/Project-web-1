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
function updateProfile($firstName, $surname, $displayName, $DOB, $phoneNumber, $mime, $avatars, $id){
    global $db;
    $stmt = $db->prepare("UPDATE `user` SET `firstName`= ?, `surname` = ?, `displayName` = ?, `DOB` = ?, `phoneNumber` = ?, `mime` = ?, `avatars` =  ? WHERE `user`.`id` = ?");
    return $stmt->execute(array($firstName, $surname, $displayName, $DOB, $phoneNumber, $mime, $avatars, $id));
}
function getNewFeeds(){
    global $db;
    $stmt = $db->query("SELECT p.*, u.displayName, u.id as idAvatar FROM posts AS p JOIN user AS u ON p.userID = u.id ORDER BY createdAt DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getMyStatus($userID){
    global $db;
    $stmt = $db->prepare("SELECT p.*, u.displayName, u.id as idAvatar, u.DOB  FROM posts AS p JOIN user AS u ON p.userID = u.id Where u.id = ? ORDER BY createdAt DESC");
    $stmt->execute(array($userID));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function createPost($userID, $content,$mime,$image,$privacy){
    global $db;
    $stmt = $db->prepare("INSERT INTO posts (content, userID,mime,image,privacy) VALUES (? ,? ,? ,? ,?)");
    $stmt->execute(array($content, $userID, $mime, $image, $privacy));
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

function loadImage($id){
    global $db;
    $stmt =$db->prepare("select * from posts where id = ?");
    $stmt->execute(array($id));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
function sendFriendRequest($userId1, $userId2)
{
  global $db;
  $stmt = $db->prepare("INSERT INTO friendship (userId1,userId2) VALUES (?, ?) ");
  $stmt->execute(array($userId1, $userId2));
}

function removeFriendRequest($userId1, $userId2)
{
  global $db;
  $stmt = $db->prepare("DELETE FROM friendship WHERE (userId1 = ? AND userId2=?) OR (userId2 = ? AND userId1=?) ");
  $stmt->execute(array($userId1, $userId2,$userId1, $userId2));
}

function getFriendShip($userId1,$userId2)
{
  global $db;
  $stmt = $db->prepare("SELECT * FROM friendship WHERE userId1 = ? AND userId2=?");
  $stmt->execute(array($userId1, $userId2));
  return $stmt->fetch(PDO::FETCH_ASSOC);
}



function addCommentToPost($postId,$userId,$content)
{
    global $db;
    $stmt = $db->prepare("INSERT INTO comments (postId,userId,content) VALUES (?, ?, ?) ");
    $stmt->execute(array($postId,$userId,$content));
}

function getCommentOfPost($postId)
{
    global $db;
    $stmt = $db->prepare("SELECT u.*,c.content,c.createdAt  FROM comments AS c JOIN user AS u ON c.userId = u.id WHERE c.postId = ? ORDER BY c.createdAt DESC");
    $stmt->execute(array($postId));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCountCommentOfPost($postId)
{
    global $db;
    $stmt = $db->prepare("SELECT COUNT(*) as totalComment FROM comments WHERE postId = ? ");
    $stmt->execute(array($postId));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getLikeOfPost($postId)
{
    global $db;
    $stmt = $db->prepare("SELECT COUNT(*) as totalLike FROM likes WHERE postId = ? ");
    $stmt->execute(array($postId));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function loadAllUser($currentUserId)
{
    global $db;
    $stmt = $db->prepare("SELECT *  FROM user WHERE id != ?");
    $stmt->execute(array($currentUserId));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function loadPostForProfile($id)
{
    global $db;
    $stmt = $db->prepare("SELECT p.*, u.displayName, u.id as idAvatar, u.DOB  FROM posts as p JOIN user as u ON p.userID = u.id WHERE userID = ? AND (privacy= 'Public' OR  privacy ='Friend' )");
    $stmt->execute(array($id));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function userLike($postId,$userId)
{
    
    global $db;
    $stmt = $db->prepare("SELECT *FROM likes WHERE postId=? and userId=?");
    $stmt->execute(array($postId,$userId));
    if($stmt->fetchAll(PDO::FETCH_ASSOC)) 
    {
        return true;
    }
    return false;
}
function addOrRemoveLike($postId,$userId)
{
    global $db;
    if(userLike($postId,$userId))
    {
        $stmt = $db->prepare("DELETE FROM likes WHERE postId=? and userId=?");
        $stmt->execute(array($postId,$userId));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        $stmt = $db->prepare("INSERT INTO likes (postId,userId) VALUES (?, ?)");
        $stmt->execute(array($postId,$userId));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}