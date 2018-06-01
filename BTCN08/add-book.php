<?php require_once 'init.php'; ?>
<?php
if (!$currentUser) {
    header('Location: index.php');
    exit();
}

$isFail = false;
$addBookSuccess = false;
$bookInfoOk = false;
$uploadedAvatarOk = false;

//refresh will not add data
if (isset($_POST['name']) && isset($_POST['author']) && isset($_POST['price']) && isset($_POST['description']) && isset($_FILES['image'])) {
    if (!empty($_POST['name']) && !empty($_POST['author']) && !empty($_POST['price']) && !empty($_POST['description'])) {

        $bookInfoOk = true;

        $name = $_POST['name'];
        $author = $_POST['author'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        $time = getdate();

        $ImagePath = 'BookCover/' . $_SESSION['userId'] . '_' . $time['0'] . '_' . $_FILES['image']['name'];

        $userId = $_SESSION['userId'];

        //upload image
        $fileTemp = $_FILES['image']['tmp_name'];

        $uploadedAvatarOk = move_uploaded_file($fileTemp, $ImagePath);
        if ($uploadedAvatarOk) {
            $newImageResized = resizeImage($ImagePath, 450, 450);
            imagejpeg($newImageResized, $ImagePath);

            $addBookSuccess = addBook($name, $author, $ImagePath, $price, $description, $userId);
        } else {
            $addBookSuccess = false;
            $isFail = true;
        }

    }else{
        $isFail = true;
    }
}

if ($addBookSuccess) {
    header('Location: add-book.php');
}

?>

<?php include 'header.php' ?>

<ol class="breadcrumb my-breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item "><a
                href="userwall.php?userId=<?php echo $currentUser['Id']; ?>"><?php echo strtoupper($currentUser['Fullname']); ?></a>
    </li>
    <li class="breadcrumb-item active">Add Book</li>
</ol>

<p class="header-title">ADD NEW BOOK</p>

<!--check add book success-->
<?php if ($isFail) : ?>
    <?php if ($bookInfoOk == false): ?>
        <div class="alert alert-danger" role="alert">
            Information of book is missing!
        </div>
    <?php endif; ?>
    <?php if ($uploadedAvatarOk == false): ?>
        <div class="alert alert-danger" role="alert">
            Upload avatar of book fail, please choose another image!
        </div>
    <?php endif; ?>
<?php endif; ?>

<div class="container my-content">
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name"
                   placeholder=" Harry Potter and the Philosopher's Stone">
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" id="author" name="author" placeholder="J.K. Rowling">
        </div>
        <div class="form-group">
            <label for="price">Price (VND)</label>
            <input type="number" min="0" max="any" class="form-control" id="price" name="price"
                   placeholder="150000">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4"
                      placeholder="Adaptation of the first of J.K. Rowling's popular children's novels about Harry Potter, a boy who learns on his eleventh birthday that he is the orphaned son of two powerful wizards and possesses unique magical powers of his own. He is summoned from his life as an unwanted child to become a student at Hogwarts, an English boarding school for wizards. There, he meets several friends who become his closest allies and help him discover the truth about his parents' mysterious deaths."
            ></textarea>
        </div>
        <div class="form-group">
            <label for="image">Book Cover Image</label><br>
            <input type="file" id="image" name="image" class="custom-file">
        </div>

        <button type="submit" class="btn btn-primary">Add Book</button>
    </form>
</div>
<?php include 'footer.php' ?>

