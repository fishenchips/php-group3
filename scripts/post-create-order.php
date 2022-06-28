<?php

require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/Order.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";

session_start();

$success1 = false;

$success2 = false;


if (isset($_POST["id"]) && isset($_SESSION["user"])) {
    $product_id = $_POST["id"];

    var_dump($product_id);

    $user = $_SESSION["user"];

    var_dump($user);

    $orders_db = new OrdersDatabase();

    $current_date = date("Y-m-d");

    $status = "ordered";

    $order = new Order($user->id, $status, $current_date);

    $product_order = new ProductOrder($order->id, $product_id);

    $success1 = $orders_db->add_order_to_orders($order);

    $success2 = $orders_db->add_order_to_product_orders($product_order);


    //gives me false --> orderId i product_orders är null för även id i orders är null
    var_dump($product_order);
} else {
    die("You need to be logged in to place an order");
}

var_dump($order);
