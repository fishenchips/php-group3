<?php

require_once __DIR__ . "/../classes/Template.php";

require_once __DIR__ . "/../classes/Order.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";
require_once __DIR__ . "/../classes/Product.php";


$is_logged_in = isset($_SESSION["user"]);

$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;

$is_admin = $is_logged_in && $logged_in_user->role == "admin";

if (!$is_admin) {
    http_response_code(401); //unauthorized
    die("Access denied");
}

$orders_db = new OrdersDatabase();

$order = $orders_db->get_order_by_id($_GET["id"]);

$products = $orders_db->get_products_by_order_id($_GET["id"]);

Template::header("Order {$_GET["id"]}", "");

Template::admin_header();
?>
<div>
    <p>Ordered: <?= $order->date ?></p>

    <?php foreach ($products as $product) : ?>
        <div>
            <p>
                <?= $product["name"] ?>
            </p>
            <img src="<?= $product["imgUrl"] ?>" alt="<?= $product["name"] ?>" width="40" height="40">
        </div>
    <?php endforeach ?>

    <?php if ($order->status == "sent") : ?>
        <form action="/php-group3/admin-scripts/admin-post-update-order.php" method="POST">
            <label>Order is sent to customer</label>
            <input type="checkbox" name="status" checked disabled>
        </form>

    <?php else : ?>

        <form action="/php-group3/admin-scripts/admin-post-update-order.php" method="POST">
            <label>Press to send to customer</label>
            <input type="hidden" name="id" value="<?= $order->id ?>">
            <input type="checkbox" name="status">
            <input type="submit" value="Send">
        </form>
    <?php endif ?>
</div>


<?php
Template::footer();
// add info from product-orders when it works