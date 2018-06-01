<?php
    $totalView = getAllViewOfUserId($_SESSION['userId']);
    $totalBook = count($bookList);
?>

<div class="book-menu">
    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Books Uploaded
            <span class="badge badge-primary badge-pill"><?php echo $totalBook?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Total View

            <span class="badge badge-primary badge-pill"><?php echo $totalView?></span>
        </li>
    </ul>
    <!--Friend End List-->
</div>