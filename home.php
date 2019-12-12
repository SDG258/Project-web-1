<?php
require_once 'init.php';
include 'header.php';

$posts = getNewFeeds();
?>
<?php if ($currentUser) : ?>
    <div class="row-">
        <form class='textcolor' action="createPost.php" method="POST">
        <div style="margin-top :20px;">
                <div class="input-group mb-3">
                    <textarea class="form-control " name="content" id="content" rows="3" placeholder="Bạn đang nghĩ gì ?"></textarea>
                </div>
                <div class="input-group-append">
                        <button type="submit" class="btn btn-primary ">Đăng nội dung</button>
                 </div>
            </div>
        </form>
    </div>

    <div class="row">
        <?php foreach ($posts as $post) : ?>
           <?php $id=$post['id']; ?>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-horizontal">
                        <div class="img-square-wrapper">
                            <img style="float: left;width: 150px;height:200px" src="avatar.php<?php echo "?id=";echo $post['id']; ?>">
                        </div>
                        <div style="margin-left:10px;" class="card-body">
                            <h1 class="card-title"> 
                                <a href= "<?php echo $post['id'] == $currentUser['id'] ? "personal.php" :"profile.php?id=$id";?>">
                                <?php echo $post['displayName']; ?>

                                
                        </a></h1>
                            <small class="text-muted">Đăng lúc: <?php echo $post['createdAt']; ?></small>
                            <p class="card-text"><?php echo $post['content']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>
<?php include 'footer.php'; ?>