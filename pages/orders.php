<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";
require_once __DIR__ . "/../classes/Product.php";

$is_logged_in = isset($_SESSION["user"]);

$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;

if (!$logged_in_user) {
    http_response_code(401); //unauthorized
    die("Access denied");
}

$user = $_SESSION["user"];

$orders_db = new OrdersDatabase();

$orders = $orders_db->get_orders_by_customer_id($user->id);


Template::header("Your Orders", "");

foreach ($orders as $order) :

    $order_products = $orders_db->get_products_by_order_id($order["id"]);
?>
    <ul>
        <li>
            <div>

                <h5>
                    Order number: <?= $order["id"] ?>
                </h5>


                <em>
                    status: <?= $order["status"] ?>
                </em>


                <?php foreach ($order_products as $products) : ?>
                    <p>
                        products : <?= $products["name"] ?>
                    </p> <?php endforeach ?>
            </div>
        </li>
    </ul>

<?php endforeach;

Template::footer();
