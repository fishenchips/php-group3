<?php

require_once __DIR__ . "/../classes/Template.php";

require_once __DIR__ . "/../classes/Order.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";

$orders_db = new OrdersDatabase();

$order = $orders_db->get_order_by_id($_GET["id"]);

Template::header("Order {$_GET["id"]}", "");
var_dump($order);


// add info from product-orders when it works