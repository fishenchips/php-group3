<?php

//load in user class prior to starting the session

//testing to add
require_once __DIR__ . "/UsersDatabase.php";

require_once __DIR__ . "/User.php";

//Include Google Configuration File
require_once __DIR__ . "/../google-config.php";
// OVAN BEHÖVER LIGGA EFTER CLASSERNA FÖR VI KAN INTE STARTA SESSIONEN INNAN DESS

$google_login_btn = '<a href="/php-group3/src/' . $google_client->createAuthUrl() . '">Login with Google</a>';
//session_start();  --> behövs inte nu för att den finns redan i google config..

class Template
{
    /* TEMPLATE HEADER */
    public static function header($topic, $file)
    {
        require_once __DIR__ . "/../google-config.php";

        $google_login_btn = '<a href="/php-group3/src/' . $google_client->createAuthUrl() . '">Login with Google</a>';

        //check if user is stored in the session variable
        $is_logged_in = isset($_SESSION["user"]);

        $logged_in_user = $is_logged_in ? $_SESSION["user"] : null;

        $is_admin =  $is_logged_in && $logged_in_user->role == "admin";

        $is_customer = $is_logged_in && $logged_in_user->role == "customer";

        //adding varibable to count number of items in cart
        $cart_count = isset($_SESSION["cart"]) ? count($_SESSION["cart"]) : 0;
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= $topic ?> - Crazy Games</title>
            <link rel="stylesheet" href="/php-group3/assets/style.css">
            <!-- for example "products.css" below -->
            <link rel="stylesheet" href="/php-group3/assets/<?= $file ?>">
        </head>

        <body>
            <header class="header">
                <h1>Crazy Games - Your choice for all board games</h1>
                <h2><?= $topic ?></h2>

                <nav>
                    <!-- visible for all -->
                    <a href="/php-group3">Home</a>
                    <a href="/php-group3/pages/products.php">Products</a>
                    <a href="/php-group3/pages/basket.php">Cart (<?= $cart_count ?>)</a>

                    <!-- visible for visitors -->
                    <?php if (!$is_logged_in) : ?>
                        <a href="/php-group3/pages/register.php">Register</a>
                        <a href="/php-group3/pages/login.php">Login</a>
                        <?= $google_login_btn ?>

                        <!-- visible for customers only -->
                    <?php elseif ($is_customer) : ?>
                        <a href="/php-group3/pages/support.php">Support</a>
                        <a href="/php-group3/pages/orders.php">Orders</a>

                        <!-- visible for admin only -->
                    <?php elseif ($is_admin) : ?>
                        <a href="/php-group3/pages/orders.php">Orders</a>
                        <a href="/php-group3/pages/admin-panel.php">Admin</a>
                    <?php endif ?>
                </nav>

                <!-- If user is logged in -->
                <?php if ($is_logged_in) : ?>
                    <p>
                        Welcome back,
                        <b>
                            <?= $logged_in_user->username ?>
                            <!-- extra info to show user is logged in as admin -->
                            <?php if ($is_admin) : ?>
                                (admin)
                            <?php endif ?>
                        </b>
                    </p>
                    <form action="/php-group3/scripts/post-logout.php" method="POST">
                        <input type="submit" value="Log out">
                    </form>
                <?php endif ?>
            </header>
        <?php
    }

    public static function admin_header()
    {
        ?>
            <nav>
                <h3>Admin stuff</h3>
                <a href="/php-group3/pages/admin-create-product.php">Create new product</a>
                <a href="/php-group3/pages/admin-products.php">See all products</a>
                <a href="/php-group3/pages/admin-create-user.php">Create new user</a>
                <a href="/php-group3/pages/admin-users.php">See all users</a>
                <a href="/php-group3/pages/admin-orders.php">See all orders</a>
            </nav>
        <?php
    }




    /* TEMPLATE FOOTER */
    public static function footer()
    { ?>
            <footer>
                <p>
                    Copyright Crazy Games 2022
                </p>

                <em>
                    Crazy Games - You choice for all board games.
                </em>
            </footer>
        </body>

        </html>
<?php }
}
