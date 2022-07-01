<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";

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

foreach ($orders as $order) : ?>
    <ul>
        <li>
            <div>

                <h5>
                    Order number: <?= $order["id"] ?>
                </h5>


                <em>
                    status: <?= $order["status"] ?>
                </em>

                <p>
                    products : ADD INFO WHEN productorders work
                </p>
            </div>
        </li>
    </ul>

<?php endforeach;

Template::footer();
