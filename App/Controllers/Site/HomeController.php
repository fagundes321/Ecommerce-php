<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Repositories\Site\ProdutoRepository;
class HomeController extends BaseController
{
    public function index()
    {
        $produtoRepository = new ProdutoRepository;

        dump($produtoRepository->listarProdutosOrdenadosComLimite(3));
        
        $dados = [
            'titulo' => 'InovaTech | Loja Virtual',
            'nome'  => 'Victor'
        ];

        // Forma 1: simples (recomendada)
        echo $this->twig->render('site_home.html', $dados);

        // Forma 2: se quiser carregar e depois renderizar
        // $template = $this->twig->load('site_home.html');
        // echo $template->render($dados);

   
        
    }
}
