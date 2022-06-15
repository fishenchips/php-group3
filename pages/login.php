<?php

require_once __DIR__ . "/../classes/Template.php";

Template::header("Login", "");
?>

<form action="/php-group3/scripts/post-login.php" method="post">
    <input type="text" name="username" placeholder="Username"> <br>
    <input type="password" name="password" placeholder="Password"> <br>
    <input type="submit" value="Login">
</form>

<?php
Template::footer();
