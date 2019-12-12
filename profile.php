<?php
require_once 'init.php';

if (!$currentUser) {
    header('Location:index.php');
    exit();
}
$userId = $_GET['id'];
$profile = findUserByID($userId);

$isFollowing = getFriendShip($currentUser['id'], $userId);
$isFollower = getFriendShip($userId, $currentUser['id']);
?>

<?php include 'header.php'; ?>
<h1><?php echo $profile['displayName']; ?></h1>
<img src="avatar.php?id=<?php echo $profile['id']; ?>">
<?php if ($isFollowing && $isFollower) : ?>
    Bạn bè
    <form method="POST" action="remove-friend.php">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <button type="submit" class="btn btn-primary">Xóa bạn bè</button>
    </form>
<?php else : ?>
    <?php if ($isFollowing && !$isFollower) : ?>
        <form method="POST" action="remove-friend.php">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <button type="submit" class="btn btn-primary">Xóa yêu cầu kết bạn</button>
        </form>
    <?php endif; ?>

    <?php if (!$isFollowing && $isFollower) : ?>
        <form method="POST" action="remove-friend.php">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <button type="submit" class="btn btn-primary">Hủy yêu cầu kết bạn</button>
        </form>
        <form method="POST" action="add-friend.php">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <button type="submit" class="btn btn-primary">Đồng ý yêu cầu kết bạn</button>
        </form>
    <?php endif; ?>



    <?php if (!$isFollowing && !$isFollower) : ?>
        <form method="POST" action="add-friend.php">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <button type="submit" class="btn btn-primary">Kết bạn</button>
        </form>
    <?php endif; ?>

<?php endif; ?>
<?php include 'footer.php'; ?>