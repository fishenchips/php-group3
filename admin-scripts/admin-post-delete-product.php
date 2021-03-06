<?php

require_once __DIR__ . "/../classes/Product_Database.php";

require_once __DIR__ . "/force-admin.php";

$success = false;

if (isset($_POST["id"])) {
    $db = new Product_Database();

    $product_id = $_POST["id"];

    $success = $db->delete_product($product_id);
} else {
    echo "Invalid input";
}

if ($success) {
    header("Location: /php-group3/pages/admin-products.php");
} else {
    echo "Error removing product from database";
}
