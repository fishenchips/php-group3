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

<form action="/php-group3/admin-scripts/admin-post-create-user.php" method="post">

    <input type="text" name="username" placeholder="Username"> <br>
    <input type="password" name="password" placeholder="Password"> <br>
    <input type="password" name="confirm-password" placeholder="Confirm your Password"> <br>
    
    <select name="role">
    <option disabled selected>Role</option>
    <option value="admin">admin</option>
    <option value="customer">customer</option>
    </select>
    
    <input type="submit" value="Register">

</form>

<br><br><br>

<?php

Template::footer();
