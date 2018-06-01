<?php
require_once 'init.php';

if (!$currentUser) {
    header('Location: index.php');
    exit();
}

$fullname = $currentUser['Fullname'];
$phone = $currentUser['Phone'];
$email = $currentUser['Email'];
$success = true;
$updatedProfileOk = false;
$uploadedAvatarOk = false;

// Kiểm tra người dùng có nhập tên
if (isset($_POST['fullname']) && isset($_POST['phone']))
{
    if (!empty($_POST['fullname'] ) && !empty($_POST['phone']))
    {
        if(($_POST['fullname'] != $fullname) or ($_POST['phone'] != $phone))
        {
            $fullname = $_POST['fullname'];
            $phone = $_POST['phone'];

            $currentUser['Fullname'] = $fullname;
            $currentUser['Phone'] = $phone;
            updateUser($currentUser);
            $updatedProfileOk = true;
        }
    }
    else {
        $success = false;
    }
}

if(isset($_FILES['avatar']))
{
    $fileTemp = $_FILES['avatar']['tmp_name'];
    $filepath= 'avatars/' . $_SESSION['userId']  . '.png';

    $uploadedAvatarOk = move_uploaded_file($fileTemp, $filepath);
    $newImageResized = resizeImage( $filepath, 250, 250);
    imagejpeg($newImageResized, $filepath);
}
?>


<?php include 'header.php' ?>
    <ol class="breadcrumb my-breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item "><a href="userwall.php?userId=<?php echo $currentUser['Id'];?>"><?php echo strtoupper($currentUser['Fullname']);?></a></li>
        <li class="breadcrumb-item active">Change Profile</li>

    </ol>

    <p class = "header-title">YOUR PROFILE INFORMATIONS</p>

    <!--check updated success-->
<?php if (!$success) : ?>
    <div class="alert alert-danger" role="alert">
        Please enter full information!
    </div>
<?php endif; ?>

    <!--Check updated success-->
<?php if ($updatedProfileOk): ?>
    <div class="alert alert-success" role="alert">
        Update Profile Success!
    </div>
<?php endif; ?>

    <!--Check updated success-->
<?php if ($uploadedAvatarOk) : ?>
    <div class="alert alert-success" role="alert">
        Update Avatar Success!
    </div>
<?php endif; ?>

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="fullname">Full Name</label>
            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Fill your full name" value="<?php echo $fullname ?>">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control " id="email" name="email" value="<?php echo $email ?>" disabled>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Fill your number phone" value="<?php echo $phone ?>">
        </div>

        <div class="form-group">
            <label for="avatar">Avatar</label><br>
            <input type="file" id = "avatar" name="avatar" class = "custom-file">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

<?php include 'footer.php' ?>