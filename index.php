<?php

require_once __DIR__ . "/classes/Template.php";

Template::header("Home", "");

Template::footer();


//testing to add
require_once __DIR__ . "/classes/UsersDatabase.php";

require_once __DIR__ . "/classes/User.php";


//Include Google Configuration File
require_once __DIR__ . "/google-config.php";
// OVAN BEHÖVER LIGGA EFTER CLASSERNA FÖR VI KAN INTE STARTA SESSIONEN INNAN DESS

$google_login_btn = '<a href="' . $google_client->createAuthUrl() . '">Login with Google</a>';


echo $google_login_btn;
