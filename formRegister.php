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
<body>
    <?php
    $firstName = null;
    $firstNameError = "";
    $surname = null;
    $surnameError = "";
    $email = null;
    $emailError = "";
    $phoneNumber = null;
    $phoneNumberError = "";
    $password = null;
    $passwordError = "";
    if (isset($_POST['signup'])) :
        $flag = false;
        if (empty($_POST["firstName"])) {
            $firstNameError = " * First name is required";
        } else {
            $firstName = test_input($_POST["firstName"]);
        }
        if (empty($_POST["surname"])) {
            $surnameError = " * Surname is required";
        } else {
            $surname = test_input($_POST["surname"]);
        }
        if (empty($_POST["email"])) {
            $emailError = " * Email is required";
        } else {
            $email = test_input($_POST["email"]);
            if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
                $emailError = " * Invalid email format";
            }
            $user = findUserByEmail($email);
            if ($user) {
                $emailError = " * The account has been duplicated. Please choose another email!";
            } else if (!$user) {
                $flag = true;
            }
        }
        if (empty($_POST["phoneNumber"])) {
            $phoneNumberError = " * Mobile Number is Required";
        } else {
            $phoneNumber = test_input($_POST["phoneNumber"]);
            if (!preg_match_all("/^(\+|\d)[0-9]{7,13}$/", $phoneNumber)) {
                $phoneNumberError = " *  Use Country Code (+84xxxxxxxxxx)";
            }
        }
        if (empty($_POST["password"])) {
            $passwordError = " * Password is required";
        } else {
            $password = $_POST['password'];
        }

        $displayName = $firstName . " " . $surname;

        $inputDay = $_POST['inputDay'];
        $inputMonth = $_POST['inputMonth'];
        $inputYear = $_POST['inputYear'];

        $DOB = $inputYear . "-" . $inputMonth . "-" . $inputDay;

        $gender = $_POST['gender'];

        $success = false;
        if (!$user && $flag && isset($_POST['firstName']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['phoneNumber']) && isset($_POST['password'])) {
            $newUserID = createUser($firstName, $surname, $displayName, $gender, $email, $password, $DOB, $phoneNumber);
            $success = true;
        } ?>
        <?php if ($success) : ?>
            <div class="alert alert-success" role="alert">Please check <a href="https://mail.google.com/mail/u/0/#inbox">gmail</a> to activate the account.</div>
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
                            <h2 class="log-title">Register</h2>
                            <form method="post">
                                <div class="form-group">
                                    <input id="firstName" name="firstName" type="text" required="required" />
                                    <label class="control-label" for="input">First name</label><i class="mtrl-select"></i>
                                    <font color="FF0000"><?php echo $firstNameError; ?></font>
                                </div>
                                <div class="form-group">
                                    <input id="surname" name="surname" type="text" required="required" />
                                    <label class="control-label" for="input">Surname</label><i class="mtrl-select"></i>
                                    <font color="FF0000"><?php echo $surnameError; ?></font>
                                </div>
                                <div class="form-group">
                                    <input id="email" name="email" type="text" required="required" />
                                    <label class="control-label" for="input">Email@</label><i class="mtrl-select"></i>
                                    <font color="FF0000"><?php echo $emailError; ?></font>
                                </div>
                                <div class="form-group">
                                    <input id="phoneNumber" name="phoneNumber" type="" required="required" />
                                    <label class="control-label" for="input">Mobile number</label><i class="mtrl-select"></i>
                                    <font color="FF0000"><?php echo $phoneNumberError; ?></font>
                                </div>
                                <div class="form-group">
                                    <input type="password" required="required" id="password" name="password" />
                                    <label class="control-label" for="input">Password</label><i class="mtrl-select"></i>
                                    <font color="FF0000"><?php echo $passwordError; ?><br></font>
                                </div>

                                <label>Birthday</label>
                                <br>
                                <div class="form-group col-md-3">
                                    <select name="inputDay" class="form-control form-control-lg">
                                        <option selected>1</option>
                                        <?php for ($i = 2; $i <= 31; $i++) { ?>
                                            <option> <?php echo $i; ?></option>
                                        <?php
                                                            } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <select name="inputMonth" class="form-control form-control-lg">
                                        <option selected>1</option>
                                        <?php for ($i = 2; $i <= 12; $i++) { ?>
                                            <option> <?php echo $i; ?></option>
                                        <?php
                                                            } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <select name="inputYear" class="form-control form-control-lg">
                                        <option selected> <?php echo date("Y") ?></option>
                                        <?php for ($i = date("Y"); $i >= 1900; $i--) { ?>
                                            <option> <?php echo $i; ?></option>
                                        <?php
                                                            } ?>
                                    </select>
                                </div>
                                <br>
                                <label>Gender</label>
                                <div class="form-radio">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" checked="checked" id="customRadioInline1" name="gender" class="custom-control-input" value="Female" /><i class="check-box"></i>Female
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" id="customRadioInline2" name="gender" class="custom-control-input" value="Male" /><i class="check-box"></i>Male
                                        </label>
                                    </div>
                                </div>
                                <br>
                                <div>
                                    <!-- <button class="mtr-btn signup" type="submit"><span>Register</span></button> -->
                                    <button name="signup" type="submit"> <span>Register</span></button>
                                </div>

                                <!-- <button name="signup" type="submit" class="btn btn-success btn-lg btn-block" style="margin-top: 5%;">Sign Up</button> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





<?php include 'footer.php'; ?>