<?php

use Twig\TwigFunction;
use App\Repositories\Site\CategoriaRepository;

$site_url = new \Twig\TwigFunction('site_url', function () {
    return 'http://' . $_SERVER['SERVER_NAME'] . ':8888';
});

// Listar as categorias no 
$categorias = new TwigFunction('categorias', function () {
    
    $categoriaRepository = new CategoriaRepository;
    return $categoriaRepository->listarCategoriasProdutos();
    
});
