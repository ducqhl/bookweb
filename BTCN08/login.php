<?php
require_once 'init.php';

$success = true;

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $user = findUserByEmail($_POST['email']);
    if ($user) {
        if (password_verify($_POST['password'], $user['Password'])) {
            $success = true;
            $_SESSION['userId'] = $user['Id'];
            header('Location: index.php');
            exit();
        } else {
            $success = false;
        }
    } else {
        $success = false;
    }
}
?>
<?php include 'header.php' ?>
    <!--Breadcrumb-->
    <ol class="breadcrumb my-breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Login</li>
    </ol>
    <!--End Breadcrumb-->
    <p class="header-title">LOGIN</p>

    <div class="container my-content">
        <?php if (!$success) : ?>
            <div class="alert alert-danger" role="alert">
                Email or Password is not valid, please try again!
            </div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="something@email.com" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

<?php include 'footer.php' ?>