<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";

$is_logged_in = isset($_SESSION["user"]);

$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;

$is_customer = $is_logged_in && $logged_in_user->role == "customer";

if (!$is_customer) {
    http_response_code(401); //unauthorized
    die("Access denied");
}

$user = $_SESSION["user"];

$orders_db = new OrdersDatabase();

$orders = $orders_db->get_orders_by_customer_id($user->id);

Template::header("Your Orders", "");

var_dump($orders);
