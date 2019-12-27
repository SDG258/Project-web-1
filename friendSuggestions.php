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

?>
<?php
if (!$currentUser) {
    header('Location:index.php');
    exit();
}

$users = loadAllUser($currentUser['id']);
?>
<div class="se-pre-con"></div>
<div class="theme-layout">

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
    <div class="feature-photo">
        <center>
            <figure><img src="images/anhbia.jpg" style="width: 1100px;height:350px"></figure>
        </center>

        <div class="container-fluid">
            <div class="row merged">
                <div class="col-lg-2 col-sm-3">
                    <div class="user-avatar">
                        <figure>
                            <img style="width:170px;height:170px;" src="avatar.php<?php echo "?id=";
                                                                                    echo $currentUser['id']; ?>">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="gap gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row merged20" id="page-contents">
                        <div class="col-lg-3">


                        </div>
                        <div class="col-lg-8">
                            <div class="central-meta">
                                <div class="frnds">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"><a class="active" href="friendSuggestions.php" data-toggle="tab">Friend Suggestions</a></li>
                                    </ul>
                                    <?php foreach ($users  as $user) : ?>
                                        <?php $id = $user['id']; ?>
                                       
                                        <div class="tab-content">
                                            <div class="tab-pane active fade show " id="frends">
                                                <ul class="nearby-contct">
                                                    <li>
                                                        <div class="card-horizontal">
                                                            <div class="img-square-wrapper">
                                                                <img class="rounded-circle" style="float: left;width: 100px;height:100px;margin:10px;" src="avatar.php<?php echo "?id=";
                                                                                                                                                                        echo $user['id']; ?>">
                                                            </div>
                                                            <div class="card-body col-md-6">
                                                                <h1 class="card-title">
                                                                    <a href="<?php echo "profile.php?id=$id"; ?>">
                                                                        <?php echo $user['displayName']; ?>
                                                                    
                                                                    </a>
                                                                </h1>

                                                                <strong><?php echo (date('Y') - date('Y', strtotime($user['DOB']))) . " Tuổi"; ?></strong>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php endforeach ?>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>



</div>


<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="js/main.min.js"></script>
<script src="js/script.js"></script>
<script src="js/map-init.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8c55_YHLvDHGACkQscgbGLtLRdxBDCfI"></script>

</body>



</html>

<?php include 'footer.php'; ?>