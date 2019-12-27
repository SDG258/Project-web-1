<!doctype html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<title>Gato</title>
	<link rel="icon" href="images/logo.png" type="image/png" sizes="16x16">

	<link rel="stylesheet" href="css/main.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/color.css">
	<link rel="stylesheet" href="css/responsive.css">

</head>
<?php
require_once 'init.php';
if (!$currentUser) {
    header('Location: index.php');
    exit();
}
?>
<!-- <?php include 'header.php'; ?> -->
<?php if (isset($_POST['firstName']) && isset($_POST['surname'])) : ?>
    <?php

    $firstName = $_POST['firstName'];
    $surname = $_POST['surname'];
    $phoneNumber = $_POST['phoneNumber'];
    $displayName = $firstName . " " . $surname;
    $DOB = $_POST['DOB'];

    $success = false;

    if (isset($_FILES['avatar'])) {
        $success = false;
        $file = $_FILES['avatar'];
        $fileType = $file['type'];
        $fileTemp = $file['tmp_name'];

        if (!empty($fileTemp) && file_exists($fileTemp)) {
            $avatar = file_get_contents($fileTemp);
        }
        else{
            $tmp = loadAvatars($currentUser['id']);
            if($tmp['avatars'] != null){
                $fileType = $tmp['mime'];
                $avatar = $tmp['avatars'];
            }
            else{
                $avatar = null;
            }
        }
            if ($displayName != null) {
                updateProfile($firstName, $surname, $displayName, $DOB, $phoneNumber, $fileType, $avatar, $currentUser['id']);
                $success = true;
            }
        }
    
    ?>
    <?php if ($success) : ?>
        <?php header('Location: home.php'); ?>
    <?php else : ?>
        <div class="alert alert-danger" role="alert">Update information failed.</div>
    <?php endif; ?>
<?php else : ?>
    <div class="theme-layout">
    <div class="container-fluid pdng0">
        <div class="row merged">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="land-featurearea">
                    <div class="land-meta">
                        <h1>GATO</h1>
                        <p>
                            Gato helps you connect and share with the people in your life.
                        </p>
                        <div class="logo">
                            <span><img src="images/logo.png" alt=""></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="login-reg-bg">
                    <div class="log-reg-area sign">
                        <h3 class="log-title">Manage personal information</h3>
                        <form class='textcolor' action="updateProfile.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <input class="form-control form-control-lg" id="firstName" name="firstName" type="text" style="margin-top: 2%" placeholder="Firstname" value="<?php echo $currentUser['firstName']; ?>">
                                <label class="control-label" for="currentPassword">Firstname</label><i class="mtrl-select"></i>
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control-lg" id="surname" name="surname" type="text" style="margin-top: 2%" placeholder="Surname" value="<?php echo $currentUser['surname']; ?>">
                                <label class="control-label" for="surname">Surname</label><i class="mtrl-select"></i>
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control-lg" id="DOB" name="DOB" type="date" style="margin-top: 2%" placeholder="Date of birth" value="<?php echo $currentUser['DOB']; ?>">
                                <label class="control-label" for="DOB">Date of birth</label><i class="mtrl-select"></i>
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control-lg" id="phoneNumber" name="phoneNumber" type="text" style="margin-top: 2%" placeholder="Phone Number" value="<?php echo $currentUser['phoneNumber']; ?>">
                                <label class="control-label" for="phoneNumber">Phone Number</label><i class="mtrl-select"></i>
                            </div>  
                            <div class="form-group">
                                <label for="avatar">Avatar</label>
                                <input type="file" class="form-control-file" id="avatar" name="avatar">
                            </div>
                            <div class="submit-btns">
                                <button class="mtr-btn signin" name="update" type="submit"><span>Update</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif;
include 'footer.php';
?>


