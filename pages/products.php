<?php

require_once __DIR__ . "/../classes/Product_Database.php";
require_once __DIR__ . "/../classes/Product.php";

$products_db = new Product_Database();

$products = $products_db -> get_all_products();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="/php-group3/assets/products.css">
</head>
<body>
    <section class="product-container">
    <?php foreach($products as $product) : ?>
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
                <form action="/php-group3/pages/basket.php" method="post">
                    <input type="hidden" name="id" value="<?= $product->id ?>">
                    <input type="submit" value="Add to basket">
            </form>
        </div>
    <?php endforeach; ?>
    </section>
</body>
</html>