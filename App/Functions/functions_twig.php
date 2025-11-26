<?php

use Twig\TwigFunction;
use App\Repositories\Site\ProdutoRepository;
use App\Classes\BreadCrumb;
use App\Repositories\Site\CategoriaRepository;
use App\Repositories\Site\ProdutosCarrinhoRepository;
use App\Classes\Carrinho;
use App\Classes\Frete;
use App\Classes\Logado;
use App\Models\Site\UserModel;

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

/**
 * Função : Total de produtos no carrinho
 * Retorna o Total de produtos no carrinho.
 * 
 */
$valorProdutosCarrinho = new TwigFunction('valorProdutosCarrinho', function () {
    $produtosCarrinhosRepository = new ProdutosCarrinhoRepository();
    return $produtosCarrinhosRepository->totalProdutosCarrinho();
});

/**
 * Função : Numero de produtos no carrinho
 * Retorna o Numero de produtos no carrinho.
 * 
 */
$numeroProdutosCarrinho = new TwigFunction('numeroProdutosCarrinho', function () {
    $produtosCarrinho =  new Carrinho;
    return $produtosCarrinho->produtosCarrinho();
});




/**
 * Função : Pegar Dados do Frete
 * Retorna os dados do Frete.
 * 
*/
$dadosFrete = new TwigFunction('dadosFrete', function () {
    return  new Frete;
    
});

/**
 * Função : Verifica se o usuario está logado
 * Retorna os dados do usuario
 * 
 */
$logado = new TwigFunction('logado', function () {
    $logado =  new Logado();
    return $logado->logado();
});

/**
 * Função : Dados do usuario
 * Retorna os dados do usuario.
 * 
 */
$user = new TwigFunction('user', function () {
    $userModel = new UserModel;
    $logado = new Logado;
        if($logado->logado()){
            return $userModel->find('id', $_SESSION['id']);
        }

});


