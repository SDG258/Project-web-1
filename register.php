<?php
require_once 'init.php';
require_once 'functions.php';
?>
<?php include 'header.php'; ?>
<h1>Đăng ký</h1>
<?php if (isset($_POST['displayName']) && isset($_POST['email']) && isset($_POST['password'])) : ?>
    <?php
        $displayName =  $_POST['displayName'];
        $email =  $_POST['email'];
        $password = $_POST['password'];

        $success = false;
        $user = findUserByEmail($email);
        if (!$user) : {
                $newUserID = createUser($displayName, $email, $password);
                $success = true;
            }
            ?>
    <?php else : ?>
        <div class="alert alert-success" role="alert">Tài khoản đã bị trùng!!!Vui lòng nhập Email khác</div>
    <?php endif; ?>
    <?php if ($success) : ?>
        <div class="alert alert-success" role="alert">Vui lòng kiểm tra email để kích hoạt tài khoản</div>
    <?php endif; ?>
<?php else : ?>
    <form action="register.php" method="POST">
        <div class="form-group">
            <label for="displayName">Họ tên</label>
            <input type="text" class="form-control" id="displayName" name="displayName" planceholder="Họ và tên">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" planceholder="Email">
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" planceholder="Mật khẩu">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Đăng ký</button>
    </form>
<?php endif;
include 'footer.php';
?>