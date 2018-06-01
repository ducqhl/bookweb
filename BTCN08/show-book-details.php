<?php require_once 'init.php'; ?>
<?php
if (!isset($_GET['id'])) {
    header('Location: index.php');
}

$uploader = getUploaderOfBook($_GET['id']);

$book = getBook($_GET['id']);

if (!$book) {
    header('Location: index.php');
}

addNewView($_GET['id']);
?>

<?php include 'header.php' ?>

<ol class="breadcrumb my-breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item active"><?php echo $book['Name'] ?></li>
</ol>

<p class="header-title">BOOK INFORMATION</p>

<!--check add book success-->

<div class="container my-content">
    <div class="row">
        <div class="col-md-4">
            <div class="image-book-cover-side">
                <img src="<?php echo $book['Image']; ?>" alt="Book Cover">
            </div>
        </div>
        <div class="col-md-8">
            <div class="book-detail-side">
                <p class="header-title"><?php echo mb_strtoupper($book['Name'], 'utf-8') ?></p>
                <div class = "book-content-details">
                <p class="my-content"><strong><?php echo mb_strtoupper($book['Author'], 'utf-8') ?></strong></p>
                <p class="my-content"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo mb_strtoupper($book['View'], 'utf-8') ?> views</p>
                    <p class="my-content"><i class="fa fa-money" aria-hidden="true"></i> <?php echo mb_strtoupper($book['Price'], 'utf-8') ?> VND</p>
                <p class="my-content"><i class="fa fa-quote-left" aria-hidden="true"></i>
                    <em><?php echo $book['Description'] ?></em> <i class="fa fa-quote-right" aria-hidden="true"></i></p>
                <?php if(isset($_SESSION['userId']) && $book['UserId'] == $_SESSION['userId']) : ?>
                    <a href="change-book-info.php?id=<?php echo $book['Id'] ?>">
                        <button type="button" class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                    </a>
                    <a href="delete-book.php?id=<?php echo $book['Id']?>" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
                <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</div>
<?php include 'footer.php' ?>

