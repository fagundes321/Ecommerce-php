<?php

use Twig\TwigFunction;
use App\Repositories\Site\CategoriaRepository;
use App\Repositories\Site\ProdutoRepository;
use App\Classes\BreadCrumb;

$site_url = new \Twig\TwigFunction('site_url', function () {
    return 'http://' . $_SERVER['SERVER_NAME'] . ':8888';
});

// $titulo = new \Twig\TwigFunction('titulo', function () {
//     return 'InovaTech | Loja Virtual';
// });

// Listar as categorias no Dropdown
$categorias = new TwigFunction('categorias', function () {
    
    $categoriaRepository = new CategoriaRepository;
    return $categoriaRepository->listarCategoriasProdutos();
    
});

// Listar as Produtos nos Novidades
$novidade = new TwigFunction('novidade', function () {
    
    $produtoRepository = new ProdutoRepository;
    return $produtoRepository->ultimoProdutoAdicionado();
    
});


// Listar Produtos em promoção
$promocao = new TwigFunction('promocao', function () {
    
    $produtoRepository = new ProdutoRepository;
    return $produtoRepository->listarProdutosOrdenadosPelaPromocao();
    
});

// BreadCrumb
$breadCrumb = new TwigFunction('breadCrumb', function () {
   
    $breadCrumb = new BreadCrumb;
    return $breadCrumb->createBreadCrumb();
    
});

