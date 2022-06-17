<?php

require_once __DIR__ . "/../classes/Product_Database.php";
require_once __DIR__ . "/../classes/Product.php";

require_once __DIR__ . "/force-admin.php";

$success = false;

if ($_POST["price"] <= 0) {
    die("You will need to add a price to the product.");
}

if (isset($_POST["name"]) && isset($_POST["description"]) && isset($_POST["price"])) {

    $upload_directory = __DIR__ . "/../assets/uploads/";

    $upload_name = basename($_FILES["product-img"]["name"]);

    $name_parts = explode(".", $upload_name);

    $file_extension = end($name_parts);

    $timestamp = time();

    $file_name = "{$timestamp}.{$file_extension}";

    $full_upload_path = $upload_directory . $file_name;

    $full_relative_url = "/php-group3/assets/uploads/{$file_name}";

    $success = move_uploaded_file($_FILES["product-img"]["tmp_name"], $full_upload_path);

    if ($success) {
        $product = new Product($_POST["name"], $_POST["description"], $_POST["price"], $full_relative_url);

        $db = new Product_Database();

        $success = $db->save_product($product);
    }
} else {
    echo "Dont forget to add name and description to your product.";
    var_dump($_POST);
    die();
}

if ($success) {
    header("Location: /php-group3/pages/admin-products.php");
} else {
    echo "Check so you have added a image to your product.";
    die();
}
