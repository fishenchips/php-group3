<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>
<body>

    <form action="/php-group3/admin-scripts/admin-post-product.php" method="post" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Name"> <br>
        <textarea name="description" placeholder="Description"></textarea> <br>
        <input type="number" name="price" placeholder="Price"> <br>
        <input type="file" name="product-img" accept="image/*"> <br>
        <input type="submit" value="Save">
    </form>
    
</body>
</html>