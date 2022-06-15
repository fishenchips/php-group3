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


$users_db = new UsersDatabase();

$users = $users_db->get_all();

Template::header("All users (Admin view)", "");

Template::admin_header();


foreach ($users as $user) : ?>

    <p>
        <a href="/php-group3/pages/admin-edit-user.php?username=<?= $user->username ?>"><?= $user->username ?></a>
        <i><?= $user->role ?></i>
    </p>

    <form action="/php-group3/admin-scripts/admin-post-delete-user.php" method="post">
        <input type="hidden" name="id" value="<?= $user->id ?>">
        <input type="submit" value="Delete user">
    </form>

<?php endforeach;

Template::footer();
?>