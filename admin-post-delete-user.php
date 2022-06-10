<?php

require_once __DIR__ . "/classes/UsersDatabase.php";

$success = false;

if (isset($_POST["id"])) {
    $user_id = $_POST["id"];

    $db = new UsersDatabase();

    $success = $db->delete_user_by_id($user_id);
}
else{
    echo "Invalid input";
}

if($success){
    header("Location: /php-group3.php"); // ??????
}
else{
    echo "Error deleting user";
}