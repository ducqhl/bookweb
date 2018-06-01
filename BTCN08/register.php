<?php
require_once 'init.php';

$RegisterSuccess = true;

if (!empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['phone'])
    && !empty($_POST['password']) && !empty($_POST['agree-tos']) && $_POST['agree-tos'] == 'on') {
    $email = strtolower($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];

    // Kiểm tra xem email có trùng không
    $user = findUserByEmail($email);

    if ($user) {
        $RegisterSuccess = false;
    } else {
        $insertId = createUser($fullname, $email, $phone, $password);

        if ($insertId == 0) {
            $RegisterSuccess = false;
        } else {
            // Redirect to home page
            $_SESSION['userId'] = $insertId;
            header('Location: index.php');
        }
    }
}
?>

<?php include 'header.php' ?>
    <!--Breadcrumb-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Register</li>
    </ol>
    <!--End Breadcrumb-->
<?php if (!$RegisterSuccess) : ?>
    <div class="alert alert-danger" role="alert">
        Create new account failure, please try again!
    </div>
<?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <label for="fullname">Full Name</label>
            <input type="text" class="form-control" id="fullname" name="fullname"
                   placeholder="Fill your fullname right here"
                   value="<?php echo isset($_POST['fullname']) ? $_POST['fullname'] : '' ?>">
            <span class="error-messenge"><?php echo isset($_POST['fullname']) && empty($_POST['fullname']) ? 'You have to input full name' : '' ?></span>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email"
                   placeholder="Fill your email account right here"
                   value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
            <span class="error-messenge"><?php echo isset($_POST['email']) && empty($_POST['email']) ? 'You have to input email address' : '' ?></span>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="tel" class="form-control" id="phone" name="phone"
                   placeholder="Fill your phone number right here"
                   value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : '' ?>">
            <span class="error-messenge"><?php echo isset($_POST['phone']) && empty($_POST['phone']) ? 'You have to input phone number' : '' ?></span>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password"
                   placeholder="Fill your password right here">
            <span class="error-messenge"><?php echo (isset($_POST['password']) && $_POST['password'] < 6) ? 'Password lenght must larger than 6 letters' : '' ?></span>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" name="agree-tos" class="form-check-input">
                Agree to our <a href="">Terms and Data Policy</a>, including our <a href="">Cookie Use Policy</a> .
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
<?php include 'footer.php'; ?>