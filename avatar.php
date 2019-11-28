<?php
    require_once 'init.php';
    $id = isset($_GET['id'])? $_GET['id']:"";
    $row = loadAvatars($id);
    header('Content-Type:'.$row['mime']);
    echo $row['avatars'];
?>