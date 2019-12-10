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
if (isset($_POST['firstName']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['phoneNumber']) && isset($_POST['password']) && isset($_POST['signup'])):

    $firstName =  $_POST['firstName'];
    $surname =  $_POST['surname'];
    $displayName = $firstName. " ".$surname;
    

    $email =  $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $password = $_POST['password'];


    $inputDay = $_POST['inputDay'];
    $inputMonth = $_POST['inputMonth'];
    $inputYear = $_POST['inputYear'];

    $DOB = $inputYear."-".$inputMonth."-".$inputDay;

    $gender = $_POST['gender'];

    $success = false;

    $user = findUserByEmail($email);
    if (!$user) : {
            $newUserID = createUser($firstName, $surname, $displayName, $gender, $email, $password, $DOB, $phoneNumber);
            $success = true;
        }
    else : ?>
        <div class="alert alert-success" role="alert">Tài khoản đã bị trùng!!!Vui lòng nhập Email khác</div>
<?php endif; ?>
<?php if ($success) : ?>
    <div class="alert alert-success" role="alert">Vui lòng kiểm tra <a href="https://mail.google.com/mail/u/0/#inbox">gmail</a> để kích hoạt tài khoản</div>
<?php endif; ?>
<?php else : ?>
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
                    <form action="formRegister.php" method="POST">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col"><input id="firstName" name="firstName" type="text" class="form-control form-control-lg" placeholder="First name"></div>
                                <div class="col"><input id="surname" name="surname" type="text" class="form-control form-control-lg" placeholder="Surname"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input id="email" name="email" type="text" class="form-control form-control-lg" style="margin-top: 3%;" placeholder="Email address">
                            <input id="phoneNumber" name="phoneNumber" type="number" class="form-control form-control-lg" style="margin-top: 3%;" placeholder="Mobile number">
                            <input id="password" name="password" type="password" class="form-control form-control-lg" style="margin-top: 3%;" placeholder="New Password">
                            <label style="margin-top: 3%;">Birthday</label>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <select name="inputDay" class="form-control form-control-lg">
                                        <option selected>1</option>
                                        <?php for ($i =2; $i<=31;$i++)
                                        { ?>
                                            <option> <?php echo $i; ?></option>
                                            <?php
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <select name="inputMonth" class="form-control form-control-lg">
                                        <option selected>1</option>
                                        <?php for ($i =2; $i<=12;$i++)
                                        { ?>
                                            <option> <?php echo $i; ?></option>
                                            <?php
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <select name="inputYear" class="form-control form-control-lg">
                                        <option selected> <?php echo date("Y") ?></option>
                                        <?php for ($i = date("Y"); $i>=1900;$i--)
                                        { ?>
                                            <option> <?php echo $i;?></option>
                                            <?php
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <label>Gender</label>
                            <div class="form-row">
                                <div class="col-sm-5" style="margin-left: 20%;">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input checked="checked" type="radio" id="customRadioInline1" name="gender" class="custom-control-input" value="female">
                                        <label class="custom-control-label" for="customRadioInline1">Female</label>
                                    </div>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="gender" class="custom-control-input" value="male">
                                    <label class="custom-control-label" for="customRadioInline2">Male</label>
                                </div>
                            </div>
                                <button name="signup" type="submit" class="btn btn-success btn-lg btn-block" style="margin-top: 5%;">Sign Up</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php include 'footer.php'; ?>