<?php require_once 'init.php'; ?>
<?php
if (!$currentUser) {
    header('Location: index.php');
    exit();
}
if(!isset($_GET['id'])){
    header('Location: index.php');
}

$uploader = getUploaderOfBook($_GET['id']);

//if current user is not uploader of this book
if($uploader['Id'] != $_SESSION['userId']){
    header('Location: index.php');
}
$book = getBook($_GET['id']);

if(isset($_POST['agree-tos']) && $_POST['agree-tos'] == 'on'){
    deleteBook($book["Id"]);
    header('Location: index.php');
}
?>

<?php include 'header.php' ?>

<ol class="breadcrumb my-breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item "><a
            href="userwall.php?userId=<?php echo $currentUser['Id']; ?>"><?php echo strtoupper($currentUser['Fullname']); ?></a>
    </li>
    <li class="breadcrumb-item ">
        <a href="show-book-details.php?id=<?php echo $book['Id'] ?>"><?php echo $book['Name']; ?></a>
    </li>
    <li class="breadcrumb-item active">Delete</li>
</ol>

<p class="header-title">DELETE BOOK</p>

<!--check add book success-->

<div class="container my-content">
    <form method="POST">
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" name="agree-tos" class="form-check-input">
                I want to delete <strong><?php echo $book['Name']?></strong>.
            </label>
        </div>

        <button type="submit" class="btn btn-danger">Delete</button>
    </form>

</div>
<?php include 'footer.php' ?>

