<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Repositories\Site\ProdutoRepository;

/**
 * Controller responsável por exibir a página inicial da loja virtual.
 * 
 * Fluxo:
 * - Recupera produtos do repositório (caso precise exibir destaques, novidades, etc)
 * - Monta os dados que serão passados para a view
 * - Renderiza a página inicial via Twig
 */
class HomeController extends BaseController
{
    /**
     * Exibe a página inicial da loja.
     */
    public function index()
    {

     

        // Instancia o repositório de produtos
        $produtoRepository = new ProdutoRepository;

        // Exemplo de testes com o carrinho (comentados)
        // $carrinho = new \App\Classes\Carrinho;
        // dump($carrinho->produtoCarrinho(1));
        // dump($carrinho->statusCarrinho->carrinho());

        // Dados que serão enviados para a view
        $dados = [
            'titulo' => 'InovaTech | Loja Virtual',
            'nome'   => 'Victor'
        ];

        // Forma 1: simples e direta (recomendada)
        echo $this->twig->render('site_home.html', $dados);

        // Forma 2: alternativa, primeiro carrega o template
        // $template = $this->twig->load('site_home.html');
        // echo $template->render($dados);
    }
}
