<?php
    require_once 'init.php';
    $id = isset($_GET['id'])? $_GET['id']:"";
    $row = loadImage($id);
    header('Content-Type:'.$row['mime']);
    echo $row['image'];
?>