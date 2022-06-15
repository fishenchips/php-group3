<?php

require_once __DIR__ . "/../classes/Template.php";

require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";

$is_logged_in = isset($_SESSION["user"]);

$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;

$is_admin = $is_logged_in && $logged_in_user->role == "admin";

if (!$is_admin) {
    http_response_code(401); //unauthorized
    die("Access denied");
}

Template::header("Create new user (Admin view)", "");

Template::admin_header();
?>

<br><br><br>

<h1>Kod för denna sida saknas</h1>
<h1>Kod för denna sida saknas</h1>
<br><br><br>

<?php

Template::footer();
