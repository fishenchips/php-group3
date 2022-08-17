<?php

require_once __DIR__ . "/../classes/User.php";  

require_once __DIR__ . "/../google-config.php";

require_once __DIR__ . "/../classes/Template.php";

$google_login_btn = '<a href="' . $google_client->createAuthUrl() . '">Login with Google</a>';

Template::header("Login", "");
?>

<form action="/php-group3/scripts/post-login.php" method="post">
    <input type="text" name="username" placeholder="Username"> <br>
    <input type="password" name="password" placeholder="Password"> <br>
    <input type="submit" value="Login">
</form>
<?= $google_login_btn ?>

<?php


Template::footer();
