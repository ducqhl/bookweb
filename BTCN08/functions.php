<?php

function findUserByEmail($email) {
  global $db;
  $stmt = $db->prepare("SELECT * FROM user WHERE Email = ?");
  $stmt->execute(array(strtolower($email)));
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  return $user;
}

function findUserById($id) {
  global $db;
  $stmt = $db->prepare("SELECT * FROM user WHERE Id = ?");
  $stmt->execute(array($id));
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  return $user;
}

function createUser($fullname, $email, $phone, $password) {
  global $db;
  $stmt = $db->prepare("INSERT INTO user (Fullname, Email, Phone, Password, DayRegisted) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP())");
  $stmt->execute(array($fullname, $email, $phone, $password));
  return $db->lastInsertId();
}

function updateUser($user) {
  global $db;
  $stmt = $db->prepare("UPDATE user SET Fullname = ?, Phone = ? WHERE id = ?");
  $stmt->execute(array($user['fullname'], $user['phone'], $user['id']));
  return $user;
}

function updateUserPassword($userId, $hashPassword) {
    global $db;
    $stmt = $db->prepare("UPDATE user SET password = ? WHERE id = ?");
    $stmt->execute(array($hashPassword, $userId));
}

function resizeImage($filename, $max_width, $max_height)
{
    list($orig_width, $orig_height) = getimagesize($filename);

    $width = $orig_width;
    $height = $orig_height;

    # taller
    if ($height > $max_height) {
        $width = ($max_height / $height) * $width;
        $height = $max_height;
    }

    # wider
    if ($width > $max_width) {
        $height = ($max_width / $width) * $height;
        $width = $max_width;
    }

    $image_p = imagecreatetruecolor($width, $height);

    $image = imagecreatefromstring(file_get_contents($filename));

    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);

    return $image_p;
}
function getBook($bookId)
{
    global $db;
    //b.Id, b.Name b.Image, b.Price, b.Description, b.UserId, b.DayAdd
    $stmt = $db->prepare("SELECT 	* FROM book WHERE Id = ?");
    $stmt->execute(array($bookId));
    $books = $stmt->fetch(PDO::FETCH_ASSOC);
    return $books;
}
function getBookList()
{
    global $db;
    //b.Id, b.Name b.Image, b.Price, b.Description, b.UserId, b.DayAdd
    $stmt = $db->prepare("SELECT 	* FROM book ORDER BY book.DayAdd DESC");
    $stmt->execute();
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $books;
}

function getBookListByUserId($UserId)
{
    global $db;
    //b.Id, b.Name b.Image, b.Price, b.Description, b.UserId, b.DayAdd
    $stmt = $db->prepare("SELECT 	b.* FROM book as b WHERE b.UserId = ? ORDER BY b.DayAdd DESC");
    $stmt->execute(array($UserId));
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $books;
}

function addBook($name, $author,$ImagePath, $price, $description, $userId)
{
    global $db;
    $stmt = $db->prepare("INSERT INTO book(Name, Author, Image, Price, Description, UserId, DayAdd) VALUES (?, ?, ?, ?, ?, ?,  CURRENT_TIMESTAMP())");
    $stmt->execute(array($name, $author,$ImagePath, $price, $description, $userId));
    return $db->lastInsertId();
}

function updateBook($id, $name, $author,$ImagePath, $price, $description)
{
    global $db;
    $stmt = $db->prepare("UPDATE book SET Name = ?, Author = ?, Image = ?, Price = ?, Description = ? WHERE Id = ?");
    $stmt->execute(array($name, $author, $ImagePath, $price, $description, $id));
}

function deleteBook($bookId)
{
    global $db;
    $stmt = $db->prepare("DELETE FROM book WHERE Id = ?");
    $stmt->execute(array($bookId));
}
function getUploaderOfBook($bookId)
{
    global $db;
    $stmt = $db->prepare("SELECT user.* FROM user JOIN book ON user.Id = book.UserId WHERE book.Id = ?");
    $stmt->execute(array($bookId));
    $User = $stmt->fetch(PDO::FETCH_ASSOC);
    return $User;
}

function addNewView($bookId){
    global $db;
    $stmt = $db->prepare("UPDATE book SET View = View + 1 WHERE Id = ?");
    $stmt->execute(array($bookId));
}

function getAllViewOfUserId($userId){
    global $db;
    $stmt = $db->prepare("SELECT sum(book.View)as view FROM book WHERE book.UserId = ?");
    $stmt->execute(array($userId));
    $views = $stmt->fetch(PDO::FETCH_ASSOC);
    return $views['view'];
}

function startsWith($haystack, $needle)
{
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

function endsWith($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 ||
        (substr($haystack, -$length) === $needle);
}

?>