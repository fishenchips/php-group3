<?php

require_once __DIR__ . "/../classes/Product_Database.php";

$success = false;

if ($_POST["price"] <= 0) {
    die("Your price value can't be less then 1.");
}

if (isset($_POST["name"]) && isset($_POST["description"]) && isset($_POST["price"]) && isset($_GET["id"])) {

    $upload_directory = __DIR__ . "/../assets/uploads/";

    $upload_name = basename($_FILES["product-img"]["name"]);

    $name_parts = explode(".", $upload_name);

    $file_extension = end($name_parts);

    $timestamp = time();

    $file_name = "{$timestamp}.{$file_extension}";

    $full_upload_path = $upload_directory . $file_name;

    $full_relative_url = "/php-group3/assets/uploads/{$file_name}";

    $success = move_uploaded_file($_FILES["product-img"]["tmp_name"], $full_upload_path);

    if($success) {
        $updated_product = new Product($_POST["name"], $_POST["description"], $_POST["price"], $full_relative_url);
        
        $db = new Product_Database();

        $success = $db->update_product($updated_product, $_GET["id"]);
    }
}
else {
    echo "Invalid input";
    var_dump($_POST);
}

if($success) {
    header ("Location: /php-group3/pages/admin-products.php");
}
else {
    echo "Error updating product to database, when updating a product you always need to choose a img.";
}