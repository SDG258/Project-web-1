<?php
    require_once 'init.php'; 
    if(!$currentUser){
    header('Location: index.php');
        exit();
    }
    
    $postId=$_POST['postId'];
    $userId = $currentUser['id'];
    $content = $_POST['contentComment'];
    $page=$_POST['page'];
    if($page=="profile")
    {
        $profileId=$_POST['profileId'];
    }


    if(!empty(trim($content))){
        addCommentToPost($postId,$userId,$content);
    }
   
    if($page=="home")
   {
    header('Location: home.php');
   }
    else if($page=="personal")
    {
        header('Location: personal.php');
    }
    else{
        header('Location: profile.php?id='.$profileId);
    }
?>
