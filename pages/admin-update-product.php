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
    <title>Update product</title>
    <link rel="stylesheet" href="/php-group3/assets/update-product.css">
</head>
<body>
    <h1>Update product with new info</h1>

        <form class="input-frame" action="/php-group3/admin-scripts/admin-post-update-product.php?id=<?= $_GET["id"] ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="name" value="<?= $product->name ?>" placeholder="New name"> <br>
        <textarea name="description" placeholder="New description"><?= $product->description ?></textarea> <br>
        <input type="number" name="price" value="<?= $product->price ?>" placeholder="New Price"> <br>
        <input type="file" name="product-img" accept="image/*"> <br>
        <input type="submit" value="Update">
        </form>
</body>
</html>