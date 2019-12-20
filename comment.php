<?php
    require_once 'init.php'; 
    if(!$currentUser){
    header('Location: index.php');
        exit();
    }
    
    $postId=$_POST['postId'];
    $userId = $currentUser['id'];
    $content = $_POST['contentComment'];
    if(!empty(trim($content))){
        addCommentToPost($postId,$userId,$content);
    }
   
    header('Location: home.php');
?>