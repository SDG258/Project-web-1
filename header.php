<!doctype html>
<html lang="en">

<head>
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

    <title>Đồ Án Web 1</title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href=home.php><strong>GATO</strong></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?php echo $page == 'home' ? 'active' : '' ?>">
                        <a class="nav-link" href="home.php"><strong>Trang chủ</strong></a>
                    </li>
                    <?php if (!$currentUser) : ?>
                        <li class="nav-item<?php echo $page == 'register' ? 'active' : '' ?>">
                            <a class="nav-link" href="register.php"> <strong>Đăng ký</strong></a>
                        </li>
                        <li class="nav-item<?php echo $page == 'login' ? 'active' : '' ?>">
                            <a class="nav-link" href="login.php"> <strong>Đăng nhập</strong></a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item<?php echo $page == 'updateProfile' ? 'active' : '' ?>">
                            <a class="nav-link" href="updateProfile.php"> <strong>Cập nhật thông tin cá nhân</strong></a>
                        </li>
                        <li class="nav-item<?php echo $page == 'changePassword' ? 'active' : '' ?>">
                            <a class="nav-link" href="changePassword.php"><strong>Đổi mật khẩu</strong></a>
                        </li>
                        <li class="nav-item<?php echo $page == 'personal' ? 'active' : '' ?>">
                            <a class="nav-link" href="personal.php"><strong> Trang cá nhân</strong></a>
                        </li>
                        <li class="nav-item<?php echo $page == 'friendSuggestions' ? 'active' : '' ?>">
                            <a class="nav-link" href="friendSuggestions.php"><strong> Gợi ý kết bạn</strong></a>
                        </li>
                        <li class="nav-item<?php echo $page == 'Messager' ? 'active' : '' ?>">
                            <a class="nav-link" href="formMessager.php"><strong> Tin nhắn</strong></a>
                        </li>
                        <li class="nav-item<?php echo $page == 'logout' ? 'active' : '' ?>">
                            <a class="nav-link" href="logout.php"> <strong>Đăng xuất<?php echo  $currentUser ? '(' . $currentUser['displayName'] . ')' : '' ?></strong></a>
                        </li>
                    <?php endif; ?>
            </div>
        </nav>