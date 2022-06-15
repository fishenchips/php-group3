<?php

require_once __DIR__ . "/../classes/UsersDatabase.php";

if (isset($_POST["username"]) && isset($_POST["password"])) {

    $users_db = new UsersDatabase();

    $user = $users_db->get_by_username($_POST["username"]);

    if ($user && $user->testing_password($_POST["password"])) {

        session_start();

        $_SESSION["user"] = $user;

        header("Location: /php-group3");
    } else {

        die("Invalid username or pass");
    }
} else {
    die("invalid input");
}
