<?php
require_once 'init.php';
if (!$currentUser) {
    header('Location: index.php');
    exit();
}
?>
<?php include 'header.php'; ?>
<?php $toUserID = findUserByID($_SESSION['id']); ?>
<?php
$count = 0;
$messagers = loadMessage($currentUser['id'], $toUserID['id']);
if(isset($_POST['delete'])){
    $id = $_POST['delete'];
    deleteMessage($id);
    header('Location: messager.php');
}
foreach ($messagers as $messager) { ?>
    <?php if ($currentUser['id'] == $messager['fromUserID']) { ?>
        <form class='textcolor' action="messager.php" method="POST" enctype="multipart/form-data">
            <div class="card" style="text-align: right">
                <div class="card-body">
                    <p class="card-text"> <?php echo $messager['content']; ?> <span style="font-size: 10px"><?php echo $messager['createdAt']; ?></span> </p>
                </div>
                <button type="submit" value="<?php echo $messager['id']; ?>" name="delete" class="btn btn-outline-danger">Delete</button>
            </div>
        </form>
    <?php } ?>
    <?php if ($currentUser['id'] != $messager['fromUserID']) { ?>
        <div class="card">
            <div class="card-body">
                <p class="card-text"> <?php echo $messager['content']; ?> <span style="font-size: 10px"><?php echo $messager['createdAt']; ?></span></p>
            </div>
        </div>
    <?php } ?>
<?php } ?>
<?php if (isset($_POST['send']) && isset($_POST['message'])) {
    $message = $_POST['message'];
    sendMessage($currentUser['id'], $toUserID['id'], $message);
    header('Location: messager.php');
}
?>
<form class='textcolor' action="messager.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <div class="row" style="margin-top: 50%">
            <div class="col-sm-10" style="margin-top: 1%">
                <input type="text" name="message" class="form-control form-control-lg" autocomplete="off" autofocus placeholder="Viết tin nhắn vào đây...">
            </div>
            <button type="submit" name="send" class="btn btn-outline-primary btn-lg">Gửi tin nhắn</button>
        </div>
    </div>
</form>
<?php include 'footer.php'; ?>