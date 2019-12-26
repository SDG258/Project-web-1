<?php
require_once 'init.php';

$posts = getMyStatus($currentUser['id']);
//Xử lý logic ở đây
?>
<?php include 'header.php'; ?>

<div class="media" style="border: 2px solid #ffffff;">
    <div class="media-left">
        <img style="float: left;width: 150px;" src="avatar.php<?php echo "?id=";
                                                                echo $currentUser['id']; ?>">
    </div>
    <div style="text-indent: 10px;">
        <h2 style="margin-left:20px"><?php echo $currentUser['displayName'];
                                        ?></h2>
        <ul>
            <li><strong>Ngày sinh:</strong> <?php echo $currentUser['DOB'];
                                            ?></li>
            <li><strong>Số điện thoại:</strong> <?php echo $currentUser['phoneNumber'];
                                                ?></li>
            <li><strong>Email:</strong> <?php echo $currentUser['email'];
                                        ?></li>
            <li><strong>Giới tính:</strong> <?php echo $currentUser['gender'];
                                            ?></li>
        </ul>
    </div>

</div>

<div class="row-">
    <div class="card">
        <form enctype="multipart/form-data" action="createPost.php" method="POST">
            <div class="input-group input-group-sm mb-0 " style="margin: 10px;">
                <textarea class="form-control form-control-sm " name="content" id="content" rows="3" placeholder="Bạn đang nghĩ gì ?"></textarea>
                <div class="input-group-append" style="margin-right:20px;">
                    <input type="hidden" name="page" value="personal">
                    <button type="submit" class="btn btn-primary ">Đăng nội dung</button>
                </div>
            </div>

            <div class="row" style="margin: 10px">
                <div class="col-sm-4" style="margin-top: 10px;">
                    <select style="background: transparent; border:5px solid #E50239;" name="privacy">
                        <option value="Public"> Public </option>
                        <option value="Friend"> Friend </option>
                        <option value="Private"> Only me </option>
                    </select>
                </div>
                <div class="col-sm-4" style="margin: 10px">
                    <div class="image-upload">
                        <label for="file-input">
                            <i class="fas fa-images"></i>Thêm ảnh
                        </label>

                        <input class="form-control-file" id="file-input" type="file" name="image" />
                    </div>
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
                        <img class="rounded-circle" style="float: left;width: 60px;height:60px;margin:10px;border: double #B2CCFF;" src="avatar.php<?php echo "?id=";
                                                                                                                                                    echo $post['idAvatar']; ?>">
                    </div>
                    <div class="card-body col-md-6">
                        <h1 class="card-title">
                            <a href="<?php echo $post['idAvatar'] == $currentUser['id'] ? "personal.php" : "profile.php?id=$id"; ?>">
                                <?php echo $post['displayName']; ?>
                            </a>
                        </h1>

                        <?php if ($post['privacy'] == "Public") : ?>
                            <i class="fas fa-globe-americas"></i>
                        <?php elseif ($post['privacy'] == "Friend") : ?>
                            <i class="fas fa-user-friends"></i>
                        <?php else : ?>
                            <i class="fas fa-lock"></i>
                        <?php endif; ?>
                        <small class="text-muted">Đăng lúc: <?php echo $post['createdAt']; ?></small>
                    </div>
                </div>

                <div style="margin-left: 20px;">
                    <p class="card-text"><?php echo $post['content']; ?></p>
                    <?php if ($post['image'] != null) : ?>
                        <img style="width: 150px;height:200px" src="image.php<?php echo "?id=";
                                                                                echo $post['id']; ?>">
                    <?php endif; ?>
                </div>

                <div class="row" style="margin:10px;">
                    <div class="col-sm-6">
                        <form enctype="multipart/form-data" action="like.php" method="POST">
                            <input type="hidden" name="postId" value="<?php echo $post['id']; ?>">
                            <input type="hidden" name="page" value="personal">
                            <button name="like" type="submit"> <i class="far fa-thumbs-up"></i></button>
                            <?php $countLike = getLikeOfPost($post['id']) ?>
                            <?php echo "(" . $countLike[0]["totalLike"] . ")"; ?>
                        </form>

                    </div>
                    <div class="col-sm-6">
                        <label name="comment" for="comment"> <i class="far fa-comments"></i></label>
                        <?php $countComment = getCountCommentOfPost($post['id']) ?>
                        <?php echo "Bình luận(" . $countComment[0]["totalComment"] . ")"; ?>
                    </div>
                </div>

                <form action="comment.php" method="POST" style="margin:10px;">
                    <div class="input-group input-group-sm mb-0">
                        <textarea class="form-control form-control-sm " name="contentComment" id="contentComment" rows="3" placeholder="Viết bình luận ..."></textarea>

                        <div class="input-group-append">
                            <input type="hidden" name="postId" value="<?php echo $post['id']; ?>">
                            <input type="hidden" name="page" value="personal">
                            <button type="submit" class="btn btn-primary ">Bình luận</button>
                        </div>
                    </div>
                </form>
                <?php $comments = getCommentOfPost($post['id']); ?>

                <?php foreach ($comments as $comment) : ?>
                    <?php $id = $comment['id']; ?>
                    <div class="container">
                        <div class="media">
                            <div class="media-left">
                                <img class="rounded-circle" style="float: left;width: 50px;height:50px;" src="avatar.php<?php echo "?id=";
                                                                                                                        echo $comment['id']; ?>">
                            </div>
                            <div style="text-indent: 10px;">
                                <h3 style="text-indent: 10px;">
                                    <a href="<?php echo $comment['id'] == $currentUser['id'] ? "personal.php" : "profile.php?id=$id"; ?>">
                                        <?php echo $comment['displayName']; ?>
                                    </a>
                                </h3>
                                <div>
                                    <small class="text-muted"><?php echo $comment['createdAt']; ?></small>
                                    <p class="card-text"><?php echo $comment['content']; ?></p>
                                </div>
                            </div>
                        </div>

                    </div>

                <?php endforeach ?>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?php include 'footer.php'; ?>