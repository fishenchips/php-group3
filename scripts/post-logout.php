<?php

session_start();

unset($_SESSION["user"]);

session_destroy();

//wrong redirect, should be php-group3
header("Location: /php-group3");
