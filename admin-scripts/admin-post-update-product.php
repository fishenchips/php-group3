<?php

// Under construction 
require_once __DIR__ . "/../classes/Product_Database.php";

require_once __DIR__ . "/force-admin.php";

$db = new Product_Database();

$success = false;

if (isset($_POST["name"], $_POST["description"], $_POST["id"])) {

    $upload_directory = __DIR__ . "/../assets/uploads/";

    $upload_name = basename($_FILES["product-img"]["name"]);

    $name_parts = explode(".", $upload_name);

    $file_extension = end($name_parts);

    $timestamp = time();

    $file_name = "{$timestamp}.{$file_extension}";

    $full_upload_path = $upload_directory . $file_name;

    $full_relative_url = "/php-group3/assets/uploads/{$file_name}";

    $success = move_uploaded_file($_FILES["product-img"]["tmp_name"], $full_upload_path);

    $updated_product = new Product($_POST["name"], $_POST["description"], $_POST["price"], $full_relative_url, $_POST["id"]);

    $success = $db->update_product($updated_product);
} else {
    echo "Invalid input";
    var_dump($_POST);
}

if ($success) {
    header("Location: /php-group3/pages/admin-panel");
} else {
    echo "Error updating product to database";
}
