<?php
require_once 'init.php';
include 'header.php';

$posts = getNewFeeds();
?>
<?php if ($currentUser) : ?>
    <P>Chào mừng <strong><?php echo $currentUser['displayName']; ?></strong> đã trở lại</p>
    <form action="createPost.php" method="POST">
        <div class="form-group">
            <textarea class="form-control" name="content" id="content" rows="3"  placeholder="Bạn đang nghĩ gì ?"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Đăng</button>
    </form>
<div class="row">
    <?php foreach ($posts as $post) : ?>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><img style="width: 100px;" src="avatar.php<?php echo "?id=";echo $post['id']; ?>"></h5>
                    <h5><?php echo $post['displayName'];?></h5>
                    <h6 class="card-subtitle mb -2 text-muted"><?php echo $post['createdAt'];?></h6>
                    <p class="card-text"><?php echo $post['content'] ?></p>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?php endif ?>
<?php include 'footer.php'; ?>