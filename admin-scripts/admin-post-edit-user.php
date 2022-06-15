<?php

require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";

$db = new UsersDatabase();

$success = false;

if (isset($_POST["role"]) && isset($_POST["id"])) {
    $user_role = $_POST["role"];
    $user_id = $_POST["id"];

    $success = $db->update($user_role, $user_id);
}
else{
    echo "Invalid input";
}
if ($success) {
    header("Location: /php-group3/pages/admin.php");
} else {
    echo "Error saving edited user to database";
}
