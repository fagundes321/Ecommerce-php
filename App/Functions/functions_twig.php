<?php

use Twig\TwigFunction;
use App\Repositories\Site\CategoriaRepository;
use App\Repositories\Site\ProdutoRepository;
use App\Classes\BreadCrumb;

/**
 * Função Twig: site_url
 * Retorna a URL base do site.
 * Exemplo de uso no template: {{ site_url() }}
 */
$site_url = new TwigFunction('site_url', function () {
    return 'http://' . $_SERVER['SERVER_NAME'] . ':8888';
});

/**
 * Função Twig: categorias
 * Retorna todas as categorias de produtos para exibição em dropdowns.
 * Exemplo de uso no template: {{ categorias() }}
 */
$categorias = new TwigFunction('categorias', function () {
    $categoriaRepository = new CategoriaRepository;
    return $categoriaRepository->listarCategoriasProdutos();
});

/**
 * Função Twig: novidade
 * Retorna os últimos produtos adicionados para exibir em "Novidades".
 * Exemplo de uso no template: {{ novidade() }}
 */
$novidade = new TwigFunction('novidade', function () {
    $produtoRepository = new ProdutoRepository;
    return $produtoRepository->ultimoProdutoAdicionado();
});

/**
 * Função Twig: promocao
 * Retorna produtos em promoção para exibir na seção de promoções.
 * Exemplo de uso no template: {{ promocao() }}
 */
$promocao = new TwigFunction('promocao', function () {
    $produtoRepository = new ProdutoRepository;
    return $produtoRepository->listarProdutosOrdenadosPelaPromocao();
});

/**
 * Função Twig: breadCrumb
 * Retorna o breadcrumb atual da página.
 * Exemplo de uso no template: {{ breadCrumb() }}
 */
$breadCrumb = new TwigFunction('breadCrumb', function () {
    $breadCrumb = new BreadCrumb;
    return $breadCrumb->createBreadCrumb();
});
