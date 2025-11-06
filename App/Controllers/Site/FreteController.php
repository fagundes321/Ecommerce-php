<?php 

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Repositories\Site\ProdutosCarrinhoRepository;

class FreteController extends BaseController{

    private $produtoCarrinhoRepository;

    public function __construct()
    {
        $this->produtoCarrinhoRepository = new ProdutosCarrinhoRepository();
    }
    
    public function calcular(){
        $produtosCarrinho = $this->produtoCarrinhoRepository->produtosNoCarrinho();
        
        if(empty($produtosCarrinho)){
            echo json_encode('produto');
            die();
        }
    }

}