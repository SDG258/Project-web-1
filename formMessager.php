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
?>
<div class="row">
    <?php foreach ($messages  as $message) : ?>
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
                            <a href="messager.php">
                                <?php echo $message['displayName']; ?>
                            </a>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?php include 'footer.php'; ?>