<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Gato</title>
    <link rel="icon" href="images/logo.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="style.css">


</head>
<?php
require_once 'init.php';

$limit = 3;
$pagenum = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$posts = getMyStatusWithPaging($currentUser['id'], $limit, $pagenum);

$totalPost = intval(getTotalPostOfMy($currentUser['id'])[0]['total_post']);
$totalPage = intval($totalPost % $limit != 0 ? $totalPost / $limit + 1 : $totalPost / $limit);

//Xử lý logic ở đây
?>

<body>
    <div class="se-pre-con"></div>
    <div class="theme-layout">

        <div class="responsive-header">
        </div>
        <div class="topbar stick">
            <div class="logo">
            </div>
            <div class="top-area">


                <ul class="main-menu">
                    <a title="" href="home.php"><img src="images/logo.png" alt="" style="width: 20px;height:20px"></a>

                    <li class="nav-item <?php echo $page == 'home' ? 'active' : '' ?>">
                        <a class="nav-link" href="home.php"><strong>Home</strong></a>
                    </li>
                    <?php if (!$currentUser) : ?>
                        <li class="nav-item<?php echo $page == 'register' ? 'active' : '' ?>">
                            <a class="nav-link" href="formRegister.php"><strong>Registration</strong></a>
                        </li>
                        <li class="nav-item<?php echo $page == 'login' ? 'active' : '' ?>">
                            <a class="nav-link" href="index.php"> <strong>Login</strong></a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item<?php echo $page == 'updateProfile' ? 'active' : '' ?>">
                            <a class="nav-link" href="updateProfile.php"> <strong>Manage personal information</strong></a>
                        </li>
                        <li class="nav-item<?php echo $page == 'changePassword' ? 'active' : '' ?>">
                            <a class="nav-link" href="changePassword.php"><strong>Change Password</strong></a>
                        </li>
                        <li class="nav-item<?php echo $page == 'personal' ? 'active' : '' ?>">
                            <a class="nav-link" href="personal.php"><strong>Personal Page</strong></a>
                        </li>
                        <li class="nav-item<?php echo $page == 'personal' ? 'active' : '' ?>">
                            <a class="nav-link" href="friendSuggestions.php"><strong>Friend Suggestions</strong></a>
                        </li>
                        <li class="nav-item<?php echo $page == 'Messager' ? 'active' : '' ?>">
                            <a class="nav-link" href="formMessager.php"><strong> Message</strong></a>
                        </li>
                        <li class="nav-item<?php echo $page == 'logout' ? 'active' : '' ?>">
                            <a class="nav-link" href="logout.php"> <strong>Logout<?php echo  $currentUser ? '(' . $currentUser['displayName'] . ')' : '' ?></strong></a>
                        </li>
                    <?php endif; ?>
                </ul>



            </div>
        </div>
    </div>
    <section>
        <div class="feature-photo">
            <center>
                <figure><img src="images/anhbia.jpg" style="width: 1100px;height:350px"></figure>
            </center>

            <div class="container-fluid">
                <div class="row merged">
                    <div class="col-lg-2 col-sm-3">
                        <div class="user-avatar">
                            <figure>
                                <img style="width:170px;height:170px;" src="avatar.php<?php echo "?id=";
                                                                                        echo $currentUser['id']; ?>">
                            </figure>
                        </div>
                    </div>
                    <div class="col-lg-10 col-sm-9">
                        <div class="timeline-info">
                            <ul>
                                <li class="admin-name">
                                    <h5 style="margin-left:20px"><?php echo $currentUser['displayName']; ?></h5>
                                </li>
                                <li>
                                    <a class="" href="personal.php" title="" data-ripple="">Time line</a>
                                    <a class="" href="about.php" title="" data-ripple="">About</a>
                                    <a class="" href="friendSuggestions.php" title="" data-ripple="">Friend Suggestions</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="gap gray-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row merged20" id="page-contents">
                            <div class="col-lg-3">
                            </div>
                            <div class="col-lg-8">
                                <div class="">
                                    <div class="central-meta new-pst item">
                                        <div class="new-postbox">
                                            <figure>
                                                <img style="width:55px;height:55px;" src="avatar.php<?php echo "?id=";
                                                                                                    echo $currentUser['id']; ?>">
                                            </figure>
                                            <div class="newpst-input">
                                                <div class="row-">
                                                    <form enctype="multipart/form-data" action="createPost.php" method="POST">
                                                        <textarea class="form-control " name="content" id="content" rows="3" placeholder="What's on your mind?"></textarea>
                                                        <div class="attachments">
                                                            <ul>
                                                                <li>
                                                                    <div class="image-upload">
                                                                        <div class="image-upload">
                                                                            <label for="file-input">
                                                                                <i class="fas fa-images"></i>
                                                                            </label>

                                                                            <input class="form-control-file" id="file-input" type="file" name="image" />
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div>
                                                                        <select style="background: transparent; border:5px solid #E50239;" name="privacy">
                                                                            <option value="Public"> Public </option>
                                                                            <option value="Friend"> Friend </option>
                                                                            <option value="Private"> Only me </option>
                                                                        </select>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div>
                                                                        <input type="hidden" name="page" value="personal">
                                                                        <button type="submit" class="btn btn-primary">Post</button>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
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
                                                            <small class="text-muted"><?php echo $post['createdAt']; ?></small>
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
                                                                <button name="like" type="submit"> <i <?php if (userLike($post['id'], $currentUser['id'])) : ?> class="fas fa-thumbs-up" <?php else : ?> class="far fa-thumbs-up" <?php endif; ?>></i></button>
                                                                <?php $countLike = getLikeOfPost($post['id']) ?>
                                                                <?php echo "(" . $countLike[0]["totalLike"] . ")"; ?>
                                                            </form>

                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label name="comment" for="comment"> <i class="fa fa-comments"></i></label>
                                                            <?php $countComment = getCountCommentOfPost($post['id']) ?>
                                                            <?php echo "Comment(" . $countComment[0]["totalComment"] . ")"; ?>
                                                        </div>
                                                    </div>

                                                    <form action="comment.php" method="POST" style="margin:10px;">
                                                        <div class="input-group input-group-sm mb-0">
                                                            <textarea class="form-control form-control-sm " name="contentComment" id="contentComment" rows="3" placeholder="Write a comment ..."></textarea>

                                                            <div class="input-group-append">
                                                                <input type="hidden" name="postId" value="<?php echo $post['id']; ?>">
                                                                <input type="hidden" name="page" value="personal">
                                                                <button type="submit" class="btn btn-primary ">Comment</button>
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

                                    <ul class="pagination justify-content-center" style="margin:30px ">
                                        <?php if ($pagenum - 1 > 0) : ?>
                                            <li class="page-item"> <a class="page-link" href="personal.php?page=<?php echo $pagenum - 1; ?>">Trang Trước</a></li>
                                        <?php endif; ?>

                                        <?php if ($pagenum < $totalPage) : ?>
                                            <li class="page-item"> <a class="page-link" href="personal.php?page=<?php echo $pagenum + 1; ?>">Trang Kế</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>


<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="js/main.min.js"></script>
<script src="js/script.js"></script>

</body>


</html>
<?php include 'footer.php'; ?>