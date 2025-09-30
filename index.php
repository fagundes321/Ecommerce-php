<?php 

// Evita que requests de arquivos de imagem (png, jpg, jpeg, gif) passem pelo roteador PHP
if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
    return false; // deixa o servidor servir o arquivo estático diretamente
} else {
    // Inicia a sessão PHP
    session_start();

    // Define a controller e método padrão caso a URI não tenha nenhum especificado
    define('DEFAULT_CONTROLLER', 'home');
    define('DEFAULT_METHOD', 'index');

    // Autoload do Composer
    require __DIR__ . "/vendor/autoload.php";

    // Funções auxiliares do Twig
    require __DIR__ . "/App/Functions/functions_twig.php";

    // Bootstrap da aplicação (configurações, rotas, controllers)
    require __DIR__ . "/public/bootstrap/bootstrap.php";
}
