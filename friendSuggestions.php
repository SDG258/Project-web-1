<?php
require_once 'init.php';
include 'header.php';
?>

<h1 class='textcolor'>Gợi ý kết bạn</h1>

<?php
if (!$currentUser) {
    header('Location:index.php');
    exit();
}

$users = loadAllUser($currentUser['id']);
?>
<div class="row">
    <?php foreach ($users  as $user) : ?>
        <?php $id = $user['id']; ?>
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-horizontal">
                    <div class="img-square-wrapper">
                        <img class="rounded-circle" style="float: left;width: 100px;height:100px;margin:10px;" src="avatar.php<?php echo "?id=";
                                                                                                                                echo $user['id']; ?>">
                    </div>
                    <div class="card-body col-md-6">
                        <h1 class="card-title">
                            <a href="<?php echo "profile.php?id=$id"; ?>">
                                <?php echo $user['displayName']; ?>
                            </a>
                        </h1>
                        <div class="textcolor">
                            <strong><?php echo  (date('Y') - date('Y', strtotime($user['DOB'])))." Tuổi";?></strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?php include 'footer.php'; ?>