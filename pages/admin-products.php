<?php
require_once __DIR__ . "/../classes/Template.php";

require_once __DIR__ . "/../classes/Product_Database.php";
require_once __DIR__ . "/../classes/Product.php";

$is_logged_in = isset($_SESSION["user"]);

$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;

$is_admin = $is_logged_in && $logged_in_user->role == "admin";

if (!$is_admin) {
    http_response_code(401); //unauthorized
    die("Access denied");
}

$products_db = new Product_Database();

$products = $products_db->get_all_products();

Template::header("Show all products (Admin view)", "products");

Template::admin_header();
?>

<h4>Here you can update or delete products that are active in store</h4>

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
            <form action="/php-group3/pages/admin-update-product.php">
                <input type="hidden" name="id" value="<?= $product->id ?>">
                <input type="submit" value="Update">
            </form>
            <form action="/php-group3/admin-scripts/admin-post-delete-product.php" method="post">
                <input type="hidden" name="id" value="<?= $product->id ?>">
                <input type="submit" value="Delete">
            </form>
        </div>
    <?php endforeach; ?>
</section>

<?php

Template::footer();
