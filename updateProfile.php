<?php
require_once 'init.php';
if (!$currentUser) {
    header('Location: index.php');
    exit();
}
?>
<?php include 'header.php'; ?>
<h1>Quản lý thông tin cá nhân</h1>
<?php if (isset($_POST['displayName'])) : ?>
    <?php
        $displayName = $_POST['displayName'];
        $phoneNumber = $_POST['phoneNumber'];
        $DOB = $_POST['DOB'];

        $success = false;

        if (isset($_FILES['avatar'])) {
            $success = false;
            $file = $_FILES['avatar'];
            $fileType = $file['type'];
            $fileTemp = $file['tmp_name'];

            $avatar = file_get_contents($fileTemp);

            if ($displayName != null) {
                updateProfile($displayName, $DOB, $phoneNumber, $fileType, $avatar, $currentUser['id']);
                $success = true;
            }
        }
        ?>
    <?php if ($success) : ?>
        <?php header('Location: home.php'); ?>
    <?php else : ?>
        <div class="alert alert-danger" role="alert">Cập nhật thông tin thất bại</div>
    <?php endif; ?>
<?php else : ?>
    <form action="updateProfile.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="displayName">Họ tên</label>
            <input type="text" class="form-control" id="displayName" name="displayName" planceholder="Họ tên" value="<?php echo $currentUser['displayName']; ?>">
        </div>
        <div class="form-group">
            <label for="DOB">Ngày tháng năm sinh</label>
            <input type="date" class="form-control" id="DOB" name="DOB" planceholder="Ngày tháng năm sinh" value="<?php echo $currentUser['DOB']; ?>">
        </div>
        <div class="form-group">
            <label for="phoneNumber">Số điện thoại</label>
            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" planceholder="Số điện thoại" value="<?php echo $currentUser['phoneNumber']; ?>">
        </div>
        <div class="form-group">
            <label for="avatar">Ảnh đại diện</label>
            <input type="file" class="form-control-file" id="avatar" name="avatar">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Cập nhật thông tin cá nhân</button>
    </form>
<?php endif;
include 'footer.php';
?>