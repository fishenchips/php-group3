<?php

require_once __DIR__ . "/classes/User.php";
require_once __DIR__ . "/classes/UsersDatabase.php";

$user_id = $_GET["id"];

$db = new UsersDatabase();

$user = $db->get_by_username($user_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>

    <link rel="stylesheet" href="/php-group3/assets/style.css">
</head>

<body>
    <h1>Edit User</h1>

    <nav>
        <a href="/php-group3/admin-post-edit-user.php?id=<?= $user->id ?>">Back to admin</a>
    </nav>

    <hr>

    <form action="/php-group3/admin-post-edit-user.php" method="post">
        <input type="hidden" name="id" value="<?= $user->id ?>"> 
        <input type="text" name="username" placeholder="Username" value="<?= $user->username ?>"> <br>
        <input type="text" name="password" placeholder="Password" value="<?= $user->password_hash ?>"> <br>
        <select name="role" id="role">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
        <br><br>
        <input type="submit" value="Save">
    </form>


</body>

</html>