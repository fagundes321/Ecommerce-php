<?php

use Twig\TwigFunction;
use App\Repositories\Site\CategoriaRepository;
use App\Repositories\Site\ProdutoRepository;

$site_url = new \Twig\TwigFunction('site_url', function () {
    return 'http://' . $_SERVER['SERVER_NAME'] . ':8888';
});

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



$promocao = new TwigFunction('promocao', function () {
    
    $produtoRepository = new ProdutoRepository;
    return $produtoRepository->listarProdutosOrdenadosPelaPromocao();
    
});