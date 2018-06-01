<?php
require_once 'init.php';

if (!$currentUser) {
    header('Location: index.php');
    exit();
}

$success = true;

if (isset($_POST['oldPassword']) && isset($_POST['newPassword']) && isset($_POST['newPassword2'])) {
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $newPassword2 = $_POST['newPassword2'];

    $oldPasswordOk = password_verify($oldPassword, $currentUser['password']);
    $newPasswordMatch = $newPassword == $newPassword2;
    $newPasswordLenOk = strlen($newPassword) >= 6;
    $success = $oldPasswordOk && $newPasswordMatch && $newPasswordLenOk;

    if ($success) {
        updateUserPassword($currentUser['Id'], password_hash($newPassword, PASSWORD_DEFAULT));
    }
}
?>
<?php include 'header.php' ?>
    <ol class="breadcrumb my-breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item "><a
                    href="userwall.php?userId=<?php echo $currentUser['Id']; ?>"><?php echo strtoupper($currentUser['Fullname']); ?></a>
        </li>
        <li class="breadcrumb-item active">Change Password</li>
    </ol>

    <p class="header-title">CHANGE PASSWORD</p>
<?php if (!$success) : ?>
    <div class="alert alert-danger" role="alert">
        <?php if (!$oldPasswordOk) : ?>
            Current password is not exactly!
        <?php endif; ?>
        <br>
        <?php if (!$newPasswordMatch || !$newPasswordLenOk) : ?>
            New password is not match or this lenght lower 6 character!
        <?php endif; ?>
    </div>
<?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <label for="oldPassword">Current Password</label>
            <input type="password" class="form-control" id="oldPassword" name="oldPassword"
                   placeholder="Fill your old current password">
        </div>
        <div class="form-group">
            <label for="newPassword">New Password</label>
            <input type="password" class="form-control" id="newPassword" name="newPassword"
                   placeholder="Fill your new password">
        </div>
        <div class="form-group">
            <label for="newPassword2">New Password (Again)</label>
            <input type="password" class="form-control" id="newPassword2" name="newPassword2"
                   placeholder="Fill your new password again">
        </div>
        <button type="submit" class="btn btn-primary">Change</button>
    </form>
<?php include 'footer.php' ?>