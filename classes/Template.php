<?php

//load in user class prior to starting the session
/* 
require_once __DIR__ . "/User.php";
*/

// start the session to check for loggedInStatus
session_start();

class Template
{
    /* TEMPLATE HEADER */
    public static function header($topic, $file)
    {
        //check if user is stored in the session variable
        $is_logged_in = isset($_SESSION["user"]);

        $logged_in_user = $is_logged_in ? $_SESSION["user"] : null;

        $is_admin =  $is_logged_in && $logged_in_user->admin == "admin";

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
                <h1><?= $topic ?></h1>

                <nav>
                    <!-- visible for all -->
                    <a href="/php-group3">Home</a>
                    <a href="/php-group3/pages/products.php">Products</a>

                    <!-- visible for ausers that are logged in -->
                    <?php if (!$is_logged_in) : ?>
                        <a href="/php-group3/pages/register.php">Register</a>
                        <a href="/php-group3/pages/login.php">Login</a>

                        <!-- visible for admin only -->
                    <?php elseif ($is_admin) : ?>
                        <a href="/shop/pages/admin.php">Admin</a>
                    <?php endif ?>
                </nav>

                <?php if ($is_logged_in) : ?>
                    <p>
                        Welcome back,
                        <b>
                            <?= $logged_in_user->username ?>
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



    /* TEMPLATE FOOTER */
    public static function footer()
    { ?>
            <footer>
                Copyright Philip 2018
            </footer>
        </body>

        </html>
<?php }
}
