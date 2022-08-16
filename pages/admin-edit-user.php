<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/../classes/Messages_Database.php";

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

$messages_db = new Messages_Database();

$messages = $messages_db->get_messages_by_customer_id($user->id);

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

<section>
    <h1>Messages with customer: <?= $username ?></h1>
    <form action="/php-group3/admin-scripts/admin-post-message.php" method="post">
        <input type="hidden" name="id" value="<?= $user->id ?>">
        <input type="hidden" name="role" value="support">
        <textarea name="message" placeholder="Message"></textarea> <br>
        <input type="submit" value="Send">
    </form>
</section>
<?php foreach ($messages as $message) : ?>
    <p>
        <?= $message["user"] ?>
    </p>
    <p>
        <?= $message["message"] ?>
    </p>
<?php endforeach; ?>
<section>

    <?php

    Template::footer();
