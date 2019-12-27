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
require_once 'functions.php';
?> 
<?php if (isset($_POST['email'])) : ?>
    <?php
        $email = $_POST['email'];
        $success = false;
        echo $success;
        $user = findUserByEmail($email);
        if ($user) {
            $code = generateRandomString(16);
            crateCodeForgetPassword($code, $email);
            sendEmail($email, $user['displayName'], 'Forgot password', "To reactivate your account, please click on the link: <a href = \"$BASE_URL/activatePassword.php?code=$code&&email=$email\">$BASE_URL/activatePassword.php?code=$code&&email=$email</a>");
            $success = true;
        } else { ?>
        <div class="alert alert-success" role="alert">This email does not exist in the system.</div>
    <?php } ?>
    <?php if ($success) : ?>
        <div class="alert alert-success" role="alert">Please check your email for activation.</div>
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
							<h2 class="log-title">Forgotten password</h2>
							<form method="post">
								<div class="form-group">
									<input class="form-control form-control-lg" id="email" name="email" type="email" style="margin-top: 2%" placeholder="Email address">
                                    <label class="control-label" for="input">Please enter your email address to search for your account</label><i class="mtrl-select"></i>
                                </div>
                                <div class="submit-btns">
									<button class="mtr-btn signin" name="submit" type="submit"><span>Activated</span></button>
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