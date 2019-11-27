<?php
require_once ('functions.php');
require_once ('./vendor/autoload.php');
require_once ('config.php');

session_start();
$page = detetPage();
$currentUser = null;
$db = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8", $DB_USER, $DB_PASSWORD);
if(isset($_SESSION['userID']))
{
    $currentUser = findUserById($_SESSION['userID']);
}