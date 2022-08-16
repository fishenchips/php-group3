<?php 

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/../classes/Messages_Database.php";

$is_logged_in = isset($_SESSION["user"]);

$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;

$is_customer = $is_logged_in && $logged_in_user->role == "customer";

if (!$is_customer) {
    http_response_code(401); //unauthorized
    die("Access denied");
}

$user = $_SESSION["user"];

$messages_db = new Messages_Database();

$messages = $messages_db->get_messages_by_customer_id($user->id);

Template::header("Support", "");

?>

<section>
    <h1>Contact us</h1>
    <form action="/php-group3/scripts/post-message.php" method="post">
        <input type="hidden" name="id" value="<?= $user->id ?>">
        <input type="hidden" name="role" value="<?= $user->role ?>">
        <label><?php echo $user->username ?></label> <br>
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
    
</section>

<?php

Template::footer();