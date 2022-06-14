<?php

require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";

$username = $_GET["username"];

$db = new UsersDatabase();

$user = $db->get_by_username($username);
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

    <hr>

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



   


</body>

</html>