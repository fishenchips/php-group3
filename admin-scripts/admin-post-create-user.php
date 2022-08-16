<?php

require_once __DIR__ . '/../classes/Template.php';

require_once __DIR__ . '/../classes/UsersDatabase.php';



$is_logged_in =isset($_SESSION['user']);

$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;

$is_admin = $is_logged_in && $logged_in_user->role == 'admin';

if (!$is_admin) {

    http_response_code(401);

    die("Not authorized to access this page");

}

$success = false;

if(

    isset($_POST['username']) &&

    isset($_POST['password']) &&

    strlen($_POST['username']) > 0 &&

    strlen($_POST['password']) > 0 

) {
    $user_db = new UsersDatabase();
    $user = new User($_POST['username'], "User");
    $user->hash_password($_POST['password']);
    $existing_user = $user_db->get_by_username($_POST['username']);
    
    if($existing_user == null ){
        $user_db->create($user);
        die("success");
    }
} 
 