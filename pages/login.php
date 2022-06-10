<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/php-group3/assets/style.css">
    <title>Login</title>
</head>

<body>

    <h1>Login</h1>

    <form action="/php-group3/scripts/post-login.php" method="post">
        <input type="text" name="username" placeholder="Username"> <br>
        <input type="password" name="password" placeholder="Password"> <br>
        <input type="submit" value="Login">
    </form>
</body>

</html>