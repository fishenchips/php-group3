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
    <title>See all products</title>
    <link rel="stylesheet" href="/php-group3/assets/products.css">
</head>
<body>
    <h1>Show all products</h1>
    <h2>Here can you update or delete products that are active in store</h2>
    
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
</body>
</html>