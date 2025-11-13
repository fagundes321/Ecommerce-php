<?php

use App\Classes\Template;
use App\Classes\Parameters;
use Twig\Extension\DebugExtension;



// var_dump('bootstrap: ' . $_SESSION['carrinho']);
// var_dump($_SESSION['carrinho']);

// Instancia os parâmetros da URL
$parameters = new Parameters;

// Inicializa o Twig
$template = new Template;
$twig = $template->init();

// Adiciona funções customizadas do Twig
$twig->addFunction($site_url);
$twig->addFunction($categorias);
$twig->addFunction($novidade);
$twig->addFunction($promocao);
$twig->addFunction($breadCrumb);
$twig->addFunction($valorProdutosCarrinho);
$twig->addFunction($numeroProdutosCarrinho);
$twig->addFunction($dadosFrete);

// Adiciona filtros customizados do Twig
$twig->addFilter(new \Twig\TwigFilter('array_sum', 'array_sum'));

// Habilita o DebugExtension
$twig->addExtension(new DebugExtension());

// Determina qual Controller chamar
$callController = new \App\Controllers\Controller;
$calledController = $callController->controller();
$controller = new $calledController();
$controller->setTwig($twig);

// Determina qual Método chamar
$callMethod = new App\Controllers\Method;
$method = $callMethod->method($controller);

// Obtém os parâmetros para o método
$parameters = new Parameters;
$parameter = $parameters->getParameterMethod($controller, $method);

// Chama o método com os parâmetros corretos
if ($parameter !== null) {
    // Se for array, usa call_user_func_array
    if (is_array($parameter)) {
        call_user_func_array([$controller, $method], $parameter);
    } else {
        // Se for único valor, passa diretamente
        $controller->$method($parameter);
    }
} else {
    // Se não há parâmetros, chama sem argumentos
    $controller->$method();
}
