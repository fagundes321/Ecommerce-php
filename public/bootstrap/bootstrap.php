<?php 
use App\Classes\Template;
use App\Classes\Parameters;

$parameters = new Parameters;
//dump($parameters->explodeParameters());



$template = new Template;
$twig = $template->init();

$twig->addFunction($site_url);

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

/**
 * Chamando o Controller atraves da classe controller e da classe method
 */
$controller->$method();