<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Models\Site\ProdutoModel;
use App\Models\Site\CategoriaModel;
use App\Repositories\Site\ProdutoRepository;
use App\Classes\Redirect;

class CategoriaController extends BaseController
{

    public function index($params)
    {

        $categoriaModel = new CategoriaModel;
        $categoriaEncontrada = $categoriaModel->find('categoria_slug', $params);

        $redirect = new Redirect;
        $produto = new ProdutoRepository;
        // dump($categoriaEncontrada);

        if (!$categoriaEncontrada) {
            $redirect->redirect("/");
        }

        $busca = filter_input(INPUT_GET, 'b', FILTER_SANITIZE_SPECIAL_CHARS);

        // var_dump($busca);exit;

        $busca = 'smartphones';

        $aprodutosEncontrados = $produto->buscarProduto($busca);

        $produtoModel = new ProdutoModel();
        $produtosEncontrados = $produtoModel->find('produto_categoria', $categoriaEncontrada->id);
        $dados = [
            'produtos' => $produtosEncontrados,
            'categoria' => $categoriaEncontrada,
            'testes' => $aprodutosEncontrados
        ];
        // dump($aprodutosEncontrados);
        dump($aprodutosEncontrados);

        echo $this->twig->render('site_categoria.html', $dados);
    }
}
