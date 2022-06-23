<?php

require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/Order.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";

session_start();

$success1 = false;

$success2 = false;


if (isset($_POST["id"]) && isset($_SESSION["user"])) {
    $product_id = $_POST["id"];

    $user = $_SESSION["user"];

    var_dump($user);

    $orders_db = new OrdersDatabase();

    $current_date = date("Y-m-d");

    $status = "ordered";

    $order = new Order($user->id, $status, $current_date);

    $success1 = $orders_db->add_order_to_orders($order);

    $success2 = $orders_db->add_order_to_product_orders($order->id, $product_id);

    //gives me null
    var_dump($order->id);
    //gives me false
    var_dump($success2);
} else {
    die("You need to be logged in to place an order");
}

var_dump($order);
