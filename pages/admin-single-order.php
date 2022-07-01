<?php

require_once __DIR__ . "/../classes/Template.php";

require_once __DIR__ . "/../classes/Order.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";

$is_logged_in = isset($_SESSION["user"]);

$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;

$is_admin = $is_logged_in && $logged_in_user->role == "admin";

if (!$is_admin) {
    http_response_code(401); //unauthorized
    die("Access denied");
}

$orders_db = new OrdersDatabase();

$order = $orders_db->get_order_by_id($_GET["id"]);
var_dump($order);
Template::header("Order {$_GET["id"]}", "");
?>
<div>
    <p>Ordered: <?= $order->date ?></p>

    <p>Products: NEED productORDERS TO WORK FOR THIS</p>

    <p>status:
        <em>
            <?= $order->status ?>
        </em>
    </p>

    <form action="" method="POST">
        <label>Press to send to customer</label>
        <input type="checkbox" name="status" checked disabled>
    </form>
</div>


<?php
Template::footer();
// add info from product-orders when it works