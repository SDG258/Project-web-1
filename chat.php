<?php
require_once 'init.php';
$db = new mysqli("localhost","root","","btvn");
if($db->connect_error){
    die("Connection failed: ". $db->connect_error);
}
$result = array();
$message = isset($_POST['message']) ? $_POST['message'] : null;
$from = $currentUser['id'];
$to = $_SESSION['id'];


if(!empty($message) && !empty($from) && !empty($to)){
    $sql="INSERT INTO `message` (`id`, `fromUserID`, `toUserID`, `message`, `createdAt`) VALUES (NULL, '".$from."', '".$to."', '".$message."', CURRENT_TIMESTAMP);";
    $result['send_status'] = $db->query($sql);
}
//print message
$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$items = $db->query("SELECT * FROM `message` WHERE ((fromUserID = $from AND toUserID = $to) OR (toUserID = $from AND fromUserID = $to)) AND `id` > " .$start );
while($row = $items->fetch_assoc()){
    $result['items'][] = $row;
}
$db->close();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

echo json_encode($result);
?>