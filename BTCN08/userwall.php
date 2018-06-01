<?php require_once 'init.php'; ?>
<?php
if (!$currentUser) {
    header('Location: index.php');
    exit();
}
?>
<?php
if (!isset($_GET['userId'])) {
    header('Location: index.php');
}

$user = findUserById($_GET['userId']);

$bookList = getBookListByUserId($_SESSION['userId']);
?>

<?php include 'header.php' ?>

<ol class="breadcrumb my-breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item active"><?php echo strtoupper($currentUser['Fullname']); ?></li>

</ol>

<!--Menu Bar-->
<?php include 'profile-menu.php' ?>
<div class="container back-ground-profile">
    <div class="row">
        <div class="after-side-bar">

        </div>
        <!--Profile Area-->
        <div class="col-7 list-book-uploaded">
            <p class="header-title">YOUR UPLOADED BOOKS</p>
            <div class="list-book-details">
                <?php include_once 'book-list-details.php'?>
            </div>
        </div>

        <!--FRIEND MENU-->
        <?php include 'book-menu.php' ?>
        <!--END FRIEND MENU-->
        <div class="clear-float-profile-col">
        </div> <!--End Background profile-->
    </div>
</div>
<?php include 'footer.php' ?>

