<?php
    require_once 'init.php'; 
    if(!$currentUser){
    header('Location: index.php');
        exit();
    }
    
    $postId=$_POST['postId'];
    $userId = $currentUser['id'];
    var_dump($postId,$userId);

    addOrRemoveLike($postId, $userId);
   
    header('Location: home.php');
?>