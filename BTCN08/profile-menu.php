<?php require_once 'functions.php' ?>
<div class="profile-menu">
    <div class="profile-relative-box">
        <div class="avatar-box">
            <div class="avatars-profile" style="background-image: url(avatars/<?php echo $user['Id'] ?>.png)"></div>
        </div>
        <hr style="margin-top: 10px; margin-bottom: 5px;">
        <h4><?php echo strtoupper($user['Fullname']); ?></h4>
        <hr style="margin-top: 5px; margin-bottom: 10px;">
        <div class="information-user">
            <table class="information-table">
                <tr>
                    <td>
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </td>
                    <td>
                        <em><?php echo ' ' . $user['Email'] ?></em>
                    </td>
                </tr>
                <tr>
                    <td>
                        <i class="fa fa-phone-square" aria-hidden="true"></i>
                    </td>
                    <td>
                        <em><?php echo ' ' . $user['Phone'] ?></em>
                    </td>
                </tr>
            </table>
        </div>
        <?php if ($user['Id'] == $_SESSION['userId']) : ?>
            <a href="change-profile.php" class="btn btn-outline-info btn-block" role="button" aria-pressed="true">Profile</a>
            <a href="change-password.php" class="btn btn-outline-info btn-block" role="button" aria-pressed="true">Password</a>
            <a href="add-book.php" class="btn btn-outline-info btn-block" role="button" aria-pressed="true">Add Book</a>
        <?php endif; ?>
    </div>
</div>