<?php
require_once 'init.php';
require_once 'functions.php';
?>
<?php include 'header.php'; ?>
<h1>Đăng nhập</h1>
<?php if (isset($_POST['email']) && isset($_POST['password'])) : ?>
    <?php
        $email =  $_POST['email'];
        $password = $_POST['password'];
        $success = false;
        $user = findUserByEmail($email);
        if ($user && $user['status'] == 1 && password_verify($password, $user['password'])) {
            $success = true;
            $_SESSION['userID'] = $user['id'];
        }
        ?>
    <?php if ($success) : ?>
        <?php header('Location: index.php'); ?>
    <?php else : ?>
        <div class="alert alert-danger" role="alert">Đăng nhập thất bại</div>
    <?php endif; ?>
<?php else : ?>
    <form action="login.php" method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" planceholder="Email">
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" planceholder="Mật khẩu">
        </div>
        <button type="login" name="login" class="btn btn-primary">Đăng nhập</button>
    </form>
    <form action="forgetPassword.php" method="POST" style='margin-top:-38px; margin-left: 120px;'>
        <button type="forgetPassword" name="forgetPassword" class="btn btn-primary">Quên mật khẩu</button>
    </form>
<?php endif;
include 'footer.php';
?>