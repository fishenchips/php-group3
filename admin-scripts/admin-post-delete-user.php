<?php

require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";

 
$success = false;


if (isset($_POST["id"])) {
    $user_id = $_POST["id"];

    $db = new UsersDatabase();

    $success = $db->delete($user_id);
}
else{
    echo "Invalid input";
}

if($success){
    header("Location: /php-group3/pages/admin.php"); 
}
else{

    echo "Error deleting user";
}