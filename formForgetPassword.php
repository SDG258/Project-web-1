<?php
require_once 'init.php';
if (!$currentUser) {
    header('Location: index.php');
    exit();
}
?>
<?php include 'header.php'; ?>
<h1 class='textcolor'>Đổi mật khẩu</h1>
<?php if (isset($_POST['password'])) : ?>
    <?php
        $password = $_POST['password'];
        $success = false;
        if ($currentUser) {
            updateUserPassword($currentUser['id'], $password);
            echo $currentUser['id'];
            echo $password;
            $success = true;
        }
        ?>
    <?php if ($success) : ?>
        <?php header('Location: home.php'); ?>
    <?php else : ?>
        <div class="alert alert-danger" role="alert">Đổi mật khẩu thất bại</div>
    <?php endif; ?>
<?php else : ?>
    <form class='textcolor' action="formForgetPassword.php" method="POST">
        <div class="form-group">
            <label for="password">Mật khẩu mới</label>
            <input type="password" class="form-control" id="password" name="password" planceholder="Mật khẩu mới">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Đổi mật khẩu</button>
    </form>
<?php endif;
include 'footer.php';
?>