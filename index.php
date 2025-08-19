<?php 

echo '<pre>'; 
print_r(($_SERVER["REQUEST_URI"])); 
echo '</pre>'; exit;

if(preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
    return false;
} else {
    session_start();
    require __DIR__ . "/vendor/autoload.php";
    require __DIR__ . "/App/Functions/functions_twig.php";

    require __DIR__ . "/public/assets"
}