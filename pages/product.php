<?php 
require_once __DIR__ . "/../classes/Product_Database.php";

$db = new Product_Database();

$product = $db->get_product($_GET["id"]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="/php-group3/assets/product.css">
</head>
<body>
    <a href="/php-group3/pages/products.php">Back</a>
        <div>
            <img src="<?= $product->product_img ?>" alt="">
            <h3>
                <?= $product->name ?>
            </h3>
            <p>
                <?= $product->description ?>
            </p>
            <p>
                <?= $product->price ?>
            </p>
            
            <form action="/php-group3/pages/basket.php" method="post">
                    <input type="hidden" name="id" value="<?= $product->id ?>">
                    <input type="submit" value="Add to basket">
            </form>
        </div>

</body>
</html>