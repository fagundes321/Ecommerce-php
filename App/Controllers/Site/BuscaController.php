<?php 

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Repositories\Site\ProdutoRepository;

class BuscaController extends BaseController{

    private $produto;

    public function __construct()
    {
        $this->produto = new ProdutoRepository;
    }

    public function index(){

        $busca = filter_input(INPUT_GET, 'b', FILTER_SANITIZE_SPECIAL_CHARS);
        $produtosEncontrados = $this->produto->buscarProduto($busca); 
        $dados = [
            'busca' => $busca,
            'produto' => $produtosEncontrados
        ]; 
         echo $this->twig->render('site_busca.html', $dados);
    }

}