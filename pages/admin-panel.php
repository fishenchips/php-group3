<?php

require_once __DIR__ . "/../classes/Template.php";

$is_logged_in = isset($_SESSION["user"]);

$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;

$is_admin = $is_logged_in && $logged_in_user->role == "admin";

if (!$is_admin) {
    http_response_code(401); //unauthorized
?>
    <a href="/php-group3">Go Back</a> <br>
<?php
    die("Access denied");
}

Template::header("Admin Panel", "");

Template::admin_header();

Template::footer();
