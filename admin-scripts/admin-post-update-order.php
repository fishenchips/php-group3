<?php

require_once __DIR__ . "/../classes/OrdersDatabase.php";
require_once __DIR__ . "/../classes/Order.php";

require_once __DIR__ . "/force-admin.php";

$success = false;

if (isset($_POST["status"]) && isset($_POST["id"])) {
    $orders_db = new OrdersDatabase();

    $success = $orders_db->update_order("sent", $_POST["id"]);
} else {
    die("Must check the checkbox to send order");
}

if ($success) {
    header("Location: http://localhost/php-group3/pages/admin-single-order.php?id=" . $_POST["id"]);
}
