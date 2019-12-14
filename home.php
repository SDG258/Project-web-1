<?php
require_once 'init.php';
include 'header.php';

$posts = getNewFeeds();
?>
<?php if ($currentUser) : ?>
    <div class="row-">
        <div class="card">
            <form class='textcolor' enctype="multipart/form-data" action="createPost.php" method="POST">

                <div class="col-sm-6" style="margin-top: 10px">
                    <textarea class="form-control " name="content" id="content" rows="3" placeholder="Bạn đang nghĩ gì ?"></textarea>
                </div>
                <div class="row" style="margin-top: 10px">
                    <div class="col-sm-4" style="margin-top: 10px">
                        <select style="background: transparent; border:5px solid #E50239;" name="privacy">
                            <option value="Public"> Public </option>
                            <option value="Private"> Only me </option>
                        </select>
                    </div>
                    <div class="col-sm-4" style="margin-top: 10px">
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary ">Đăng nội dung</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <?php foreach ($posts as $post) : ?>
            <?php $id = $post['idAvatar']; ?>
            <div class="container-fluid">
                <div class="card mb-3">
                    <div class="card-horizontal">
                        <div class="img-square-wrapper">
                            <img class="rounded-circle" style="float: left;width: 100px;height:100px;margin:10px;" src="avatar.php<?php echo "?id=";
                                                                                                                            echo $post['idAvatar']; ?>">
                        </div>
                        <div class="card-body col-md-6">
                            <h1 class="card-title">
                                <a href="<?php echo $post['idAvatar'] == $currentUser['id'] ? "personal.php" : "profile.php?id=$id"; ?>">
                                    <?php echo $post['displayName']; ?>

                                </a>
                            </h1>
                            <small class="text-muted">Đăng lúc: <?php echo $post['createdAt']; ?></small>
                            <p class="card-text"><?php echo $post['content']; ?></p>
                            <img style="width: 150px;height:200px" src="image.php<?php echo "?id=";
                                                                                            echo $post['id']; ?>">
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>
<?php include 'footer.php'; ?>