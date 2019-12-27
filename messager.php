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
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="style.css">


</head>
<?php
require_once 'init.php';
if (!$currentUser) {
    header('Location: index.php');
    exit();
}
?>
<?php $toUserID = findUserByID($_SESSION['id']);
echo $toUserID['id'];
?>
<div class="theme-layout">
    <div class="se-pre-con"></div>

    <div class="responsive-header">
    </div>
    <div class="topbar stick">
        <div class="logo">
        </div>
        <div class="top-area">
            <ul class="main-menu">
                <a title="" href="home.php"><img src="images/logo.png" alt="" style="width: 20px;height:20px"></a>
                <li class="nav-item <?php echo $page == 'home' ? 'active' : '' ?>">
                    <a class="nav-link" href="home.php"><strong>Home</strong></a>
                </li>
                <?php if (!$currentUser) : ?>
                    <li class="nav-item<?php echo $page == 'register' ? 'active' : '' ?>">
                        <a class="nav-link" href="formRegister.php"><strong>Registration</strong></a>
                    </li>
                    <li class="nav-item<?php echo $page == 'login' ? 'active' : '' ?>">
                        <a class="nav-link" href="index.php"> <strong>Login</strong></a>
                    </li>
                <?php else : ?>
                    <li class="nav-item<?php echo $page == 'updateProfile' ? 'active' : '' ?>">
                        <a class="nav-link" href="updateProfile.php"> <strong>Manage personal information</strong></a>
                    </li>
                    <li class="nav-item<?php echo $page == 'changePassword' ? 'active' : '' ?>">
                        <a class="nav-link" href="changePassword.php"><strong>Change Password</strong></a>
                    </li>
                    <li class="nav-item<?php echo $page == 'personal' ? 'active' : '' ?>">
                        <a class="nav-link" href="personal.php"><strong>Personal Page</strong></a>
                    </li>
                    <li class="nav-item<?php echo $page == 'personal' ? 'active' : '' ?>">
                        <a class="nav-link" href="friendSuggestions.php"><strong>Friend Suggestions</strong></a>
                    </li>
                    <li class="nav-item<?php echo $page == 'Messager' ? 'active' : '' ?>">
                        <a class="nav-link" href="formMessager.php"><strong> Message</strong></a>
                    </li>
                    <li class="nav-item<?php echo $page == 'logout' ? 'active' : '' ?>">
                        <a class="nav-link" href="logout.php"> <strong>Logout<?php echo  $currentUser ? '(' . $currentUser['displayName'] . ')' : '' ?></strong></a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

    </div>
</div>
<section>
    <div class="gap gray-bg">

        <div class="row">
            <div class="col-lg-12">
                <div class="row merged20" id="page-contents">
                    <div class="col-lg-3"></div>



                    <div class="col-lg-8">
                        <?php

                        $messagers = loadMessage($currentUser['id'], $toUserID['id']);
                        if (isset($_POST['delete'])) {
                            $id = $_POST['delete'];
                            deleteMessage($id);
                            header('Location: messager.php');
                        }
                        foreach ($messagers as $messager) { ?>
                            <?php if ($currentUser['id'] == $messager['fromUserID']) { ?>
                                <form class='textcolor' action="messager.php" method="POST" enctype="multipart/form-data">
                                    <div class="card" style="text-align: right">
                                        <div class="card-body">
                                            <p class="card-text"> <?php echo $messager['content']; ?> <span style="font-size: 10px"><?php echo $messager['createdAt']; ?></span> </p>
                                        </div>
                                        <button type="submit" value="<?php echo $messager['id']; ?>" name="delete" class="btn btn-outline-danger">Delete</button>
                                    </div>
                                </form>
                            <?php } ?>
                            <?php if ($currentUser['id'] != $messager['fromUserID']) { ?>
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-text"> <?php echo $messager['content']; ?> <span style="font-size: 10px"><?php echo $messager['createdAt']; ?></span></p>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <?php if (isset($_POST['send']) && isset($_POST['message']) && !empty($_POST['message'])) {
                            $message = $_POST['message'];
                            sendMessage($currentUser['id'], $toUserID['id'], $message);
                            header('Location: messager.php');
                        }
                        ?>
                        <form class='textcolor' action="messager.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="row" style="margin-top: 50%">
                                    <div class="col-sm-10" style="margin-top: 1%">
                                        <input type="text" name="message" class="form-control form-control-lg" autocomplete="off" autofocus placeholder="Type a message...">
                                    </div>
                                    <button type="submit" name="send" class="btn btn-outline-primary btn-lg">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
<?php include 'footer.php'; ?>
