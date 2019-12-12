<?php
require_once 'init.php';
require_once 'functions.php';
?>
<?php include 'header.php'; ?>
<h1 class='textcolor'>Kích hoạt tài khoản</h1>
<?php if (isset($_GET['code']) && isset($_GET['email'])) : ?>
    <?php
        $code = $_GET['code'];
        $email = $_GET['email'];
        $success = false;
        $success = activatePassword($code);
        $user = findUserByEmail($email);
        $_SESSION['userID'] = $user['id'];
        ?>
    <?php if ($success) : ?>
        <?php header('Location: formForgetPassword.php');
                ?>
    <?php else : ?>
        <div class="alert alert-danger" role="alert">Kích hoạt tài khoản thất bại</div>
    <?php endif; ?>
<?php endif;
include 'footer.php';
?>