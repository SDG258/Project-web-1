<?php
require_once 'init.php';
require_once 'functions.php';
?>
<!-- # add header -->
<?php include 'header.php'; ?>
<h1>Kích hoạt tài khoản</h1>
<?php if (isset($_GET['code']) && isset($_GET['email'])) : ?>
    <?php
        $code = $_GET['code'];
        $email = $_GET['email'];
        $success = false;
        $user = findUserByEmail($email);
        if ($user) {
            $success = activateUser($code);
        }
        ?>
    <?php if ($success) : ?>
        <?php header('Location: home.php'); ?>
    <?php else : ?>
        <div class="alert alert-danger" role="alert">Kích hoạt tài khoản thất bại</div>
    <?php endif; ?>
<?php endif;
include 'footer.php';
?>