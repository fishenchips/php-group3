<?php

require_once __DIR__ . "/../classes/Template.php";

require_once __DIR__ . "/../classes/User.php";
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

$orders = $orders_db->get_all_orders();

Template::header("Orders", "");

Template::admin_header();

foreach ($orders as $order) : ?>
    <div>
        <h5>
            <a href="admin-single-order.php?id=<?= $order->id ?>">Go to order number <?= $order->id ?></a>
        </h5>
    </div>

<?php endforeach;

Template::footer();
