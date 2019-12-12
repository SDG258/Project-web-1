<?php
require_once 'init.php';
if (!$currentUser) {
    header('Location: index.php');
    exit();
}
?>
<?php include 'header.php'; ?>
<h1 class='textcolor'>Đổi mật khẩu</h1>
<?php if (isset($_POST['curentPassword']) && isset($_POST['password'])) : ?>
    <?php
        $curentPassword = $_POST['curentPassword'];
        $password = $_POST['password'];

        $success = false;
        if (password_verify($curentPassword, $currentUser['password'])) {
            updateUserPassword($currentUser['id'], $password);
            $success = true;
        }
        ?>
    <?php if ($success) : ?>
        <?php header('Location: home.php'); ?>
    <?php else : ?>
        <div class="alert alert-danger" role="alert">Đổi mật khẩu thất bại</div>
    <?php endif; ?>
<?php else : ?>
    <form class='textcolor' action="changePassword.php" method="POST">
        <div class="form-group">
            <label for="curentPassword">Mật khẩu hiện tại</label>
            <input type="password" class="form-control" id="curentPassword" name="curentPassword" planceholder="Mật khẩu hiện tại">
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu mới</label>
            <input type="password" class="form-control" id="password" name="password" planceholder="Mật khẩu mới">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Đổi mật khẩu</button>
    </form>
<?php endif;
include 'footer.php';
?>