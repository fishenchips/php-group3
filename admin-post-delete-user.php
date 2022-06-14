<?php

require_once __DIR__ . "/classes/User.php";
require_once __DIR__ . "/classes/UsersDatabase.php";

 $db = new UsersDatabase();
 
$success = false;


if (isset($_POST["id"])) {
    $user_id = $_POST["id"];

   var_dump($user_id);

    $success = $db->delete($user_id);
}
else{
    echo "Invalid input";
}

if($success){
    header("Location: /php-group3.php/pages/admin.php"); 
}
else{
    echo "Error deleting user";
}