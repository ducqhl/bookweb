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

$isFail = false;
$addBookSuccess = false;

//refresh will not add data
if (isset($_POST['name']) && isset($_POST['author']) && isset($_POST['price']) && isset($_POST['description'])) {
    if (!empty($_POST['name']) && !empty($_POST['author']) && !empty($_POST['price']) && !empty($_POST['description'])) {
        $id = $_GET['id'];
        $name = $_POST['name'];
        $author = $_POST['author'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $time = getdate();

        $ImagePath = $book['Image'];
        $userId = $_SESSION['userId'];

        //upload image
        if (isset($_FILES['image'])) {
            $fileTemp = $_FILES['image']['tmp_name'];

            $uploadedAvatarOk = move_uploaded_file($fileTemp, $ImagePath);
            $newImageResized = resizeImage($ImagePath, 450, 450);
            imagejpeg($newImageResized, $ImagePath);
        }

        updateBook($id,$name, $author, $ImagePath, $price, $description);

        header('Location: change-book-info.php?id='. $book['Id'] . '.php');

    } else {
        $isFail = true;
    }
}
?>

<?php include 'header.php' ?>

<ol class="breadcrumb my-breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item "><a
            href="userwall.php?userId=<?php echo $currentUser['Id']; ?>"><?php echo strtoupper($currentUser['Fullname']); ?></a>
    </li>
    <li class="breadcrumb-item active"><?php echo $book['Name']?></li>
</ol>

<p class="header-title">UPDATE BOOK INFORMATION</p>

<!--check add book success-->

<div class="container my-content">
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name"
                   placeholder=" Harry Potter and the Philosopher's Stone" value="<?php echo $book['Name']?>">
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" id="author" name="author" placeholder="J.K. Rowling" value="<?php echo $book['Author']?>">
        </div>
        <div class="form-group">
            <label for="price">Price (VND)</label>
            <input type="number" min="0" max="any" step="1" class="form-control" id="price" name="price"
                   placeholder="150000" value="<?php echo $book['Price']?>">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4"
                      placeholder="Adaptation of the first of J.K. Rowling's popular children's novels about Harry Potter, a boy who learns on his eleventh birthday that he is the orphaned son of two powerful wizards and possesses unique magical powers of his own. He is summoned from his life as an unwanted child to become a student at Hogwarts, an English boarding school for wizards. There, he meets several friends who become his closest allies and help him discover the truth about his parents' mysterious deaths."
            ><?php echo $book['Description']?></textarea>
        </div>
        <div class="form-group">
            <label for="image">Book Cover Image</label><br>
            <input type="file" id="image" name="image" class="custom-file">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

</div>
<?php include 'footer.php' ?>

