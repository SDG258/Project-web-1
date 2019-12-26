<?php
    require_once 'init.php'; 
    if(!$currentUser){
    header('Location: index.php');
        exit();
    }
    $content = $_POST['content'];
    $privacy= $_POST['privacy'];
    $page=$_POST['page'];
    
    $file = $_FILES['image'];
    $fileType = $file['type'];
    $fileTemp = $file['tmp_name'];
    $image = file_get_contents($fileTemp);
 
    if(!empty(trim( $content))){
        createPost($currentUser['id'], $content,$fileType,$image,$privacy);
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
        header('Location: profile.php');
    }
    
    
?>