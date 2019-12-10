<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Đồ Án Web 1</title>

</head>
<body style="background-color: #EDF0F5;">
<?php
require_once 'init.php';
require_once 'functions.php';
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['login'])) :
        $email =  $_POST['email'];
        $password = $_POST['password'];
        $success = false;
        $user = findUserByEmail($email);
        if ($user && $user['status'] == 1 && password_verify($password, $user['password'])) {
            $success = true;
            $_SESSION['userID'] = $user['id'];
        }
    if ($success) :
    header('Location: home.php');
    else : ?>
        <div class="alert alert-danger" role="alert">Đăng nhập thất bại</div>
    <?php endif;
 else : ?>
    <div class="row">
        <div class="col-md-6">
            <div style="margin-top: 20%;">
                <div style="margin-left: 30%;">
                    <img src="logo.png" width="100%" >
                    <h3>Gato helps you connect and share with the people in your life.</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="margin-top: 30%;">                
                <div class="card-body">
                    <form action="index.php" method="POST">
                        <div class="form-group">
                            <input class="form-control form-control-lg" id="email" name="email" type="email" placeholder="Email address or phone number">
                            <input class="form-control form-control-lg" id="password" name="password" type="password" style="margin-top: 5%;" placeholder="Password">
                        </div>
                            <button name="login" type="submit" class="btn btn-primary btn-lg btn-block" style="margin-top: 5%;">Login</button>
                    </form>
                    <div style="text-align: center;">
                            <div style="margin-top: 3%;"><a href="forgetPassword.php">Forgotten account?</a></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-center">

                            <a href="formRegister.php"><button type="button" name="register" class="btn btn-lg btn-primary" style="background-color:#36A420;">Create New Account</button></a>    
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php include 'footer.php'; ?>