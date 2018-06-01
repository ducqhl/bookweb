<div class="row">
    <?php foreach ($bookList as $book) : ?>
        <div class="col-md-3">
            <div class="book-card">
                <a href="show-book-details.php?id=<?php echo $book['Id'] ?>" data-toggle="tooltip" data-placement="right"
                   title="<?php echo $book['Description'] ?>">
                    <div class="thumb" style="background-image: url(<?php echo "'".$book['Image']."'" ?>);">
                    </div>
                </a>
                <div class=" content-card">
                    <div class="book-name-card"><?php echo mb_strlen($book['Name'])<= 25 ? $book['Name'] : mb_substr($book['Name'],0,25, mb_internal_encoding()) . "..."  ?></div>
                    <div class="book-detail-card">

                        <table class="book-info-table">
                            <tr>
                                <td>
                                    <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                </td>
                                <td>
                                    <em><span class="author-text"><?php echo strlen($book['Author'])< 25 ? $book['Author'] : mb_substr($book['Name'],0,25, mb_internal_encoding()) . "..."  ?></span></em>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-archive" aria-hidden="true"></i>
                                </td>
                                <td>
                                    <em><div class="price-text"> <?php echo $book['Price'];?> VND</div></em>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
