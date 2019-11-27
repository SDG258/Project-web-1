<?php
    require_once 'init.php';
    $row = loadAvatars($currentUser['id']);
    header('Content-Type:'.$row['mime']);
    echo $row['avatars'];
?>