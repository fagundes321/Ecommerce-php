<?php 


    if(preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
        return false;
    } else {
            session_start();

            define('DEFAULT_CONTROLLER', 'home');
            define('DEFAULT_METHOD', 'index');

            require __DIR__ . "/vendor/autoload.php";
            require __DIR__ . "/App/Functions/functions_twig.php";
            require __DIR__ . "/public/bootstrap/bootstrap.php";
    }