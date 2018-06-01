<table class="table">
    <thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Author</th>
        <th scope="col">Price</th>
        <th scope="col">Day Add</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($bookList as $book) : ?>
        <tr>
            <td><a href="show-book-details.php?id=<?php echo $book['Id']?>"><?php echo $book['Name'];?></a></td>
            <td><?php echo $book['Author'];?></td>
            <td><?php echo $book['Price'];?></td>
            <td><?php echo $book['DayAdd'];?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

