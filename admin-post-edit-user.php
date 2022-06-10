<?php

require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/../classes/User.php";

$success = false;

if (isset($_POST["username"]) && isset($_POST["role"]) && isset($_POST["id"])) {
    $user_username = $_POST["username"];
    $user_role = $_POST["role"];
    $user_id = $_POST["id"];

    $user = new User($user_username, $user_role);

    $db = new UsersDatabase();

   $success = $db->edit_user($user, $user_id);
}
else{
    echo "Invalid input";
}


if ($success) {
    header("Location: /php-group3/admin-post-edit-user.php?id=".$_POST["id"]);
} else {
    echo "Error saving edited user to database";
}
