<?php
require_once 'init.php';
include 'header.php';
?>

<h1 class='textcolor'>Tin nhắn</h1>

<?php
if (!$currentUser) {
    header('Location:index.php');
    exit();
}

$messages = loadAllMessage($currentUser['id']);
if(isset($_POST['send'])){
    $id = $_POST['send'];
    $_SESSION['id'] =  $id;
    header('Location:messager.php');
}
?>
<div class="row">
    <?php foreach ($messages  as $message) : ?>
        <form action="formMessager.php" method="POST" enctype="multipart/form-data">
        <?php $id = $message['toUserID']; ?>
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-horizontal">
                    <div class="img-square-wrapper">
                        <img class="rounded-circle" style="float: left;width: 100px;height:100px;margin:10px;" src="avatar.php<?php echo "?id=";
                                                                                                                                echo $message['toUserID']; ?>">
                    </div>
                    <div class="card-body col-md-6">
                        <h1 class="card-title">
                        <a href="<?php echo "messager.php"; ?>"><?php echo $message['displayName']; ?>
                            </a>                        
                        </h1>                     
                    </div>
                </div>
                <button type="submit" name="send" value="<?php echo $message['toUserID']; ?>" class="btn btn-outline-primary">Nhắn tin</button>
            </div>
        </div>
        </form>
    <?php endforeach ?>
</div>

<?php include 'footer.php'; ?>