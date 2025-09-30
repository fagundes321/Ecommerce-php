<?php 

use App\Classes\Template;
use App\Classes\Parameters;
use Twig\Extension\DebugExtension;

// Instancia os parâmetros da URL
$parameters = new Parameters;
//dump($parameters->explodeParameters()); // debug

// Inicializa o Twig
$template = new Template;
$twig = $template->init();

// Adiciona funções customizadas do Twig
$twig->addFunction($site_url);
//$twig->addFunction($titulo);
$twig->addFunction($categorias);
$twig->addFunction($novidade);
$twig->addFunction($promocao);
$twig->addFunction($breadCrumb);

// Habilita o DebugExtension para poder usar {{ dump() }} e outros recursos
$twig->addExtension(new DebugExtension());

// --------------------------------------------
// Determina qual Controller chamar com base na URL
// http://localhost:0000/controller
// --------------------------------------------
$callController = new \App\Controllers\Controller;
$calledController = $callController->controller();
$controller = new $calledController();
$controller->setTwig($twig);

// --------------------------------------------
// Determina qual Método chamar com base na URL
// http://localhost:0000/controller/method
// --------------------------------------------
$callMethod = new App\Controllers\Method;
$method = $callMethod->method($controller);

// --------------------------------------------
// Captura parâmetros extras da URL
// Exemplo: /detalhes/iphone-15-pro-max
// $uriParts[0] = detalhes (controller)
// $uriParts[1] = iphone-15-pro-max (slug)
// --------------------------------------------
$uriParts = array_values(array_filter(explode('/', $_SERVER['REQUEST_URI'])));
$params = array_slice($uriParts, 1); // pega tudo depois do controller

// --------------------------------------------
// Chama o método do controller passando os parâmetros capturados
// --------------------------------------------
call_user_func_array([$controller, $method], $params);

// --------------------------------------------
// Alternativa direta (não usada atualmente)
// $controller->$method();
// --------------------------------------------
