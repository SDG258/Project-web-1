<?php
require_once 'init.php';
if (!$currentUser) {
    header('Location: index.php');
    exit();
}
?>
<?php include 'header.php'; ?>
<h1 class='textcolor'>Quản lý thông tin cá nhân</h1>
<?php if (isset($_POST['firstName']) && isset($_POST['surname'])) : ?>
    <?php
    
        $firstName = $_POST['firstName'];
        $surname = $_POST['surname'];
        $phoneNumber = $_POST['phoneNumber'];
        $displayName = $firstName. " ".$surname;
        $DOB = $_POST['DOB'];

        $success = false;

        if (isset($_FILES['avatar'])) {
            $success = false;
            $file = $_FILES['avatar'];
            $fileType = $file['type'];
            $fileTemp = $file['tmp_name'];

        if (!empty($fileTemp) && file_exists($fileTemp)) {
            $avatar = file_get_contents($fileTemp);
        }
        else{
            $tmp = loadAvatars($currentUser['id']);
            if($tmp['avatars'] != null){
                $fileType = $tmp['mime'];
                $avatar = $tmp['avatars'];
            }
            else{
                $avatar = null;
            }
        }
            if ($displayName != null) {
                updateProfile($firstName, $surname, $displayName, $DOB, $phoneNumber, $fileType, $avatar, $currentUser['id']);
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
    <form class='textcolor' action="updateProfile.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="displayName">Họ tên</label>
            <div class="form-row">
                <div class="col"><input id="firstName" name="firstName" type="text" class="form-control" placeholder="First name" value="<?php echo $currentUser['firstName']; ?>">
                </div>
                <div class="col"><input id="surname" name="surname" type="text" class="form-control" placeholder="Surname" value="<?php echo $currentUser['surname']; ?>">
                </div>
            </div>
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