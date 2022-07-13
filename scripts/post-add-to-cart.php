<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Product_Database.php";

//session after classes
session_start();

//GET id from $_POST form
if (isset($_POST["id"])) {
    $products_db = new Product_Database();

    $product = $products_db->get_product($_POST["id"]);

    //Create shopping cart if it doesnt exist in session
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }

    //add to the cart
    if ($product) {
        $_SESSION["cart"][] = $product;

        header("Location: /php-group3/pages/products.php");
        //stop the script
        die();
    }
} else {
    die("Invalid input");
}

die("Error adding product to shopping cart");
