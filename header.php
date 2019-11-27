<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Đồ Án Web 1</title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href=index.php><strong>GATO</strong></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?php echo $page == 'index' ? 'active' : '' ?>">
                        <a class="nav-link" href="index.php">Trang chủ</a>
                    </li>
                    <?php if (!$currentUser) : ?>
                        <li class="nav-item<?php echo $page == 'register' ? 'active' : '' ?>">
                            <a class="nav-link" href="register.php">Đăng ký</a>
                        </li>
                        <li class="nav-item<?php echo $page == 'login' ? 'active' : '' ?>">
                            <a class="nav-link" href="login.php">Đăng nhập</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item<?php echo $page == 'updateProfile' ? 'active' : '' ?>">
                            <a class="nav-link" href="updateProfile.php"><?php echo $currentUser ?  $currentUser['displayName'] : '' ?> </a>
                        </li>
                        <li class="nav-item<?php echo $page == 'changePassword' ? 'active' : '' ?>">
                            <a class="nav-link" href="changePassword.php">Đổi mật khẩu</a>
                        </li>
                        <li class="nav-item<?php echo $page == 'logout' ? 'active' : '' ?>">
                            <a class="nav-link" href="logout.php">Đăng xuất</a>
                        </li>
                    <?php endif; ?>
            </div>
        </nav>