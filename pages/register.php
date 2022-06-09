<?php // http://shop/pages/register.php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/php-group3/assets/style.css">
    <title>Register</title>

</head>

<body>
    <h1>Register as new user</h1>

    <nav>
        <a href="/php-group3">Back to homepage</a>
    </nav>

    <form action="/php-group3/scripts/post-register-user.php" method="post">

        <input type="text" name="username" placeholder="Username"> <br>
        <input type="password" name="password" placeholder="Password"> <br>
        <input type="password" name="confirm-password" placeholder="Confirm your Password"> <br>
        <input type="submit" value="Register">

    </form>

</body>

</html>