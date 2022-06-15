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

$username = $_GET["username"];

$db = new UsersDatabase();

$user = $db->get_by_username($username);

Template::header("Edit user", "");

Template::admin_header();
?>

<form action="/php-group3/admin-scripts/admin-post-edit-user.php" method="post">
    <input type="hidden" name="id" value="<?= $user->id ?>"> <br>
    <label><?= $user->username ?></label> <br>
    <select name="role" id="role">
        <option value="role" selected disabled>Role</option>
        <option value="admin">Admin</option>
        <option value="customer">User</option>
    </select>
    <br><br>
    <input type="submit" value="Save">
</form>

<hr>

<?php

Template::footer();
