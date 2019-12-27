<!doctype html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<title>Gato</title>
	<link rel="icon" href="images/logo.png" type="image/png" sizes="20x20">

	<link rel="stylesheet" href="css/main.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/color.css">
	<link rel="stylesheet" href="css/responsive.css">

</head>
<?php
	require_once 'init.php';
	require_once 'functions.php';
?>
<body style="background-color: #EDF0F5;">
	<?php
	$emailError = "";
	$passwordError = "";
	if (isset($_POST['login'])) :
		$email = $_POST['email'];
		$user = findUserByEmail($email);
		if (empty($_POST["email"])) {
			$emailError = " * Email is required";
		} else if (!$user) {
			$emailError = " * Email not found in the system. Please register for an account";
		}
		$password = $_POST['password'];
		if (empty($_POST["password"])) {
			$passwordError = " * Password is required";
		} else if (!password_verify($password, $user['password'])) {
			$passwordError = " * Incorrect password";
		}

		$success = false;
		$user = findUserByEmail($email);
		if ($user && $user['status'] == 1 && password_verify($password, $user['password']) && isset($_POST['email']) && isset($_POST['password'])) {
			$success = true;
			$_SESSION['userID'] = $user['id'];
		}
		if ($success) :
			header('Location: home.php'); ?>
		<?php endif; ?>
	<?php endif; ?>
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
							<h2 class="log-title">Login</h2>
							<form method="post">
								<div class="form-group">
									<input class="form-control form-control-lg" id="email" name="email" type="email" style="margin-top: 2%" placeholder="Email address">
									<label class="control-label" for="input">Email</label><i class="mtrl-select"></i>
									<font color="FF0000"><?php echo $emailError; ?></font>
								</div>
								<div class="form-group">
									<input class="form-control form-control-lg" id="password" name="password" type="password" style="margin-top: 2%" placeholder="Password">
									<label class="control-label" for="input">Password</label><i class="mtrl-select"></i>
									<font color="FF0000"><?php echo $passwordError; ?></font>
								</div>
								<a class="forgot-pwd" href="forgetPassword.php">Forgot Password ?</a>
								<div class="submit-btns">
									<button class="mtr-btn signin" name="login" type="submit"><span>Login</span></button>
									<a href="formRegister.php"><button class="mtr-btn signup" type="button"><span>Create New Account</span></button></a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include 'footer.php'; ?>