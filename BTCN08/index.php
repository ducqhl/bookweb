<?php require_once 'init.php'; ?>
<?php
$bookList = getBookList();
?>
<?php include 'header.php' ?>
    <!--Breadcrumb-->
    <ol class="breadcrumb my-breadcrumb">
        <li class="breadcrumb-item active">Home</li>
    </ol>
    <!--End Breadcrumb-->
<?php if ($currentUser) : ?>
    <p>Welcome <a href="userwall.php?userId=<?php echo $currentUser['Id']?>"><?php echo strtoupper($currentUser['Fullname']); ?></a> back!</p>
<?php else: ?>
    You're not login yet!
<?php endif ?>
    <div class="list-book">
    <?php include 'book-list.php'?>
    </div>


<?php include 'footer.php' ?>