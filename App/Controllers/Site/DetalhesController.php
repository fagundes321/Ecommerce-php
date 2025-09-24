<?php 

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Models\Site\ProdutoModel;

class DetalhesController extends BaseController{

    private $produto;

    public function __construct()
    {
        $this->produto = new ProdutoModel;
    }

   public function index($slug)
{
    $produtoEncontrado = $this->produto->find('produto_slug', $slug);

    if (!$produtoEncontrado) {
        echo "Produto não encontrado.";
        return;
    }

    $dados = [
        'produto' => $produtoEncontrado,
                 'titulo' => 'InovaTech | Loja Virtual',
    ];

    // Renderiza o template corretamente
    echo $this->twig->render('site_detalhes.html', $dados);
}



}