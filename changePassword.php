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
<?php if (isset($_POST['currentPassword']) && isset($_POST['newPassword'])) : ?>
    <?php
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];

    $success = false;

    if (password_verify($currentPassword, $currentUser['password']) && !password_verify($newPassword, $currentUser['password'])) {
        updateUserPassword($currentUser['id'], $newPassword);
        $success = true;
    }
    ?>
    <?php if ($success) : ?>
        <?php header('Location: home.php'); ?>
    <?php else : ?>
        <div class="alert alert-danger" role="alert">Password change failed. </div>
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
                            <h2 class="log-title">Change Password</h2>
                            <form method="post" class='textcolor' action="changePassword.php">
                                <div class="form-group">
                                    <input class="form-control form-control-lg" id="currentPassword" name="currentPassword" type="password" style="margin-top: 2%" placeholder="Current Password">
                                    <label class="control-label" for="currentPassword">Current Password</label><i class="mtrl-select"></i>
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-lg" id="newPassword" name="newPassword" type="password" style="margin-top: 2%" placeholder="New Password">
                                    <label class="control-label" for="newPassword">New Password</label><i class="mtrl-select"></i>
                                </div>
                                <div class="submit-btns">
                                    <button class="mtr-btn signin" name="ChangePassword" type="submit"><span>Change</span></button>
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