<?php
    require_once 'init.php'; 
    if(!$currentUser){
    header('Location: index.php');
        exit();
    }
    $content = $_POST['content'];
    $privacy= $_POST['privacy'];
    
    $file = $_FILES['image'];
    $fileType = $file['type'];
    $fileTemp = $file['tmp_name'];
    $image = file_get_contents($fileTemp);
 
    if(!empty(trim( $content))){
        createPost($currentUser['id'], $content,$image,$privacy);
    }
   
    header('Location: home.php');
?>