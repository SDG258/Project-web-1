<?php
    require_once 'init.php';
    require_once 'functions.php';
?>
<?php include 'header.php'; ?>
<h1 class='textcolor'>Quên mật khẩu</h1>
<?php if (isset($_POST['email'])): ?>
<?php
    $email = $_POST['email'];
    $success = false;
    echo $success;
    $user = findUserByEmail($email);
    if ($user) {
        $code = generateRandomString(16);
        crateCodeForgetPassword($code, $email);
        sendEmail($email, $user['displayName'], 'Quên mật khẩu', "Để kích hoạt lại tài khoản vui lòng ấn vào đường link: <a href = \"$BASE_URL/activatePassword.php?code=$code&&email=$email\">$BASE_URL/activatePassword.php?code=$code&&email=$email</a>");
        $success = true;
    }
    else{ ?>
        <div class = "alert alert-success" role ="alert">Email không tồn tại trong hệ thống !!!</div>
    <?php } ?>
<?php if ($success): ?>
<div class = "alert alert-success" role ="alert">Vui lòng kiểm tra email để kích hoạt tài khoản</div>
<?php endif; ?>
<?php else: ?>
<form class='textcolor' method = "POST">
    <div class = "form-group">
        <label for="email">Email hiện tại</label>
        <input type = "text" class ="form-control" id ="email" name ="email" planceholder ="Email">
    </div>
    <button type ="submit" name = "submit" class ="btn btn-primary">Quên mật khẩu</button>
</form>
<?php endif;
    include 'footer.php';
?>