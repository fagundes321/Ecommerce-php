<?php

namespace App\Classes;

use App\Classes\StatusCarrinho;

class Carrinho
{

    private $statusCarrinho;

    public function __construct()
    {
        $this->statusCarrinho = new StatusCarrinho();
        $this->statusCarrinho->criarCarrinho();
    }

    public function add($id)
    {
        if ($this->statusCarrinho->produtoEstaNoCarrinho($id)) {
            // se o produto já estiver no carrinho ele vai adicionar mais 1
            $_SESSION['carrinho'][$id] += 1;
        } else {
            // se  o produto não estiver no carrinho vai adicionar
            $_SESSION['carrinho'][$id] = 1;
        }
    }

    public function produtoCarrinho($id)
    {
        return $_SESSION['carrinho'][$id];
    }

    /**
     * Atualiza a quantidade de produtos no carrinho
     */
    // public function update($id, $qtd){
    //     if($this->statusCarrinho->produtoEstaNoCarrinho()){

    //     }
    // }

    public function remove($id){

    }

    public function clear(){

    }

    public function produtosCarrinho(){
        
    }
}
