<?php // http://shop/pages/register.php

require_once __DIR__ . "/../classes/Template.php";

Template::header("Register new user", "");
?>

<form action="/php-group3/scripts/post-register-user.php" method="post">

    <input type="text" name="username" placeholder="Username"> <br>
    <input type="password" name="password" placeholder="Password"> <br>
    <input type="password" name="confirm-password" placeholder="Confirm your Password"> <br>
    <input type="submit" value="Register">

</form>

<?php
Template::footer();
