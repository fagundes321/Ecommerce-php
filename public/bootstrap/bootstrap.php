<?php 
use App\Classes\Template;
use App\Classes\Parameters;


$parameters = new Parameters;
//dump($parameters->explodeParameters());



$template = new Template;
$twig = $template->init();

// chamando as funções do functionsTwig
$twig->addFunction($site_url);
$twig->addFunction($titulo);
$twig->addFunction($categorias);
$twig->addFunction($novidade);
$twig->addFunction($promocao);
$twig->addFunction($breadCrumb);


/**
 * chamando o Controller digitado na url
 * http://localHost:0000/controller
 */
$callController = new \App\Controllers\Controller;
$calledController = $callController->controller();
$controller = new $calledController();
$controller->setTwig($twig);


/**
 * chamando o metodo digitado na url
 * http://localHost:0000/controler/metodo
 */
$callMethod = new App\Controllers\Method;
$method = $callMethod->method($controller);

// --------------------------------------------
// Por enquanto está funcionando COMEÇA AQUI
// --------------------------------------------

/**
 * Capturando parâmetros extras da URL
 */
$uriParts = array_values(array_filter(explode('/', $_SERVER['REQUEST_URI'])));
// Exemplo: /detalhes/iphone-15-pro-max
// $uriParts[0] = detalhes (controller)
// $uriParts[1] = iphone-15-pro-max (slug)
$params = array_slice($uriParts, 1); // pega tudo depois do controller

/**
 * Chamando o Controller através da classe controller e da classe method
 */

//  Em vez de $controller->$method();
call_user_func_array([$controller, $method], $params);

// --------------------------------------------
// Por enquanto está funcionando TERMINA AQUI
// --------------------------------------------

/**
 * Chamando o Controller atraves da classe controller e da classe method
 */
// $controller->$method();

