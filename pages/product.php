<?php
require_once __DIR__ . "/../classes/Product_Database.php";

require_once __DIR__ . "/../classes/Template.php";


$db = new Product_Database();

$product = $db->get_product($_GET["id"]);

Template::header("Product", "product")


?>

<div>
    <img src="<?= $product->product_img ?>" alt="">
    <h3>
        <?= $product->name ?>
    </h3>
    <p>
        <?= $product->description ?>
    </p>
    <p>
        <?= $product->price ?> KR
    </p>

    <form action="/php-group3/scripts/post-add-to-cart.php" method="post">
        <input type="hidden" name="id" value="<?= $product->id ?>">
        <input type="submit" value="Add to cart">
    </form>
</div>

<?php

Template::footer();
