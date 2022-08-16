<?php

require_once __DIR__ . "/../classes/Product_Database.php";
require_once __DIR__ . "/../classes/Product.php";

require_once __DIR__ . "/../classes/Template.php";


$products_db = new Product_Database();

$products = $products_db->get_all_products();

Template::header("Products", "products")

?>

<section class="product-container">
    <?php foreach ($products as $product) : ?>
        <div class="product-card">
            <img class="product-img" src="<?= $product->product_img ?>" alt="">
            <h3 class="product-name">
                <?= $product->name ?>
            </h3>
            <p class="product-description">
                <?= $product->description ?>
            </p>
            <p class="product-price">
                <?= $product->price ?>
            </p>
            <form action="/php-group3/pages/product.php">
                <input type="hidden" name="id" value="<?= $product->id ?>">
                <input type="submit" value="Read more">
            </form>
            <!-- add to cart -->
            <form action="/php-group3/scripts/post-add-to-cart.php" method="post">
                <input type="hidden" name="id" value="<?= $product->id ?>">
                <input type="submit" value="Add to cart">
            </form>
        </div>
    <?php endforeach; ?>
</section>

<?php

Template::footer();
