<?php

require_once __DIR__ . "/../classes/Message.php";
require_once __DIR__ . "/../classes/Messages_Database.php";

$success = false;

if ($_POST["message"] == null) {
    die("You need to write something in the message box.");
}

if(isset($_POST["id"]) && isset($_POST["role"]) && isset($_POST["message"])) {

    $message = new Message($_POST["id"], $_POST["role"], $_POST["message"]);

    $db = new Messages_Database();

    $success = $db->post_message($message);
}

else {
    echo "Invalid input";
    var_dump($_POST);
    die();
}

if ($success) {
    header("Location: /php-group3/pages/admin-users.php");
} else {
    echo "Failed to save the message to the database";
    die();
}