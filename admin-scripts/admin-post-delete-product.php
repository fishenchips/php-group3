<?php

require_once __DIR__ . "/../classes/Product_Database.php";

$success = false;

if (isset($_POST["id"])) {
    $db = new Product_Database();

    $product_id = $_POST["id"];

    $success = $db->delete_product($product_id);

}
else {
    echo "Invalid input";
}

if($success) {
    header ("Location: /php-group3/pages/admin-panel.php");
}
else {
    echo "Error removing product from database";
}