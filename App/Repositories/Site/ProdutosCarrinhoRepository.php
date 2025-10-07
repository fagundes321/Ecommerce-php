<?php

namespace App\Repositories\Site;

use App\Models\Site\ProdutoModel;
use App\Classes\Carrinho;

class ProdutosCarrinhoRepository
{

    private $produtoModel;
    private $carrinho;

    public function __construct()
    {
        $this->carrinho = new Carrinho;
        $this->produtoModel = new ProdutoModel;
    }

 public function produtosNoCarrinho()
{
    $produtos = [];
    $subtotal = 0;

    foreach ($this->carrinho->produtosCarrinho() as $id => $qtd) {
        $produtoCarrinho = $this->produtoModel->find('id', $id);

        // 🔍 Verifica se o produto existe
        if (!$produtoCarrinho) {
            continue; // pula esse item
        }

        $valorProduto = ($produtoCarrinho->produto_promocao == 1)
            ? $produtoCarrinho->produto_valor_promocao
            : $produtoCarrinho->produto_valor;

        $produtos[] = [
            'produtos' => $produtoCarrinho,
            'subtotal' => $valorProduto * $qtd,
            'qtd' => $qtd,
            'valor' => $valorProduto
        ];
    }

    return $produtos;
}

public function totalProdutosCarrinho()
{
    $total = 0;

    foreach ($this->carrinho->produtosCarrinho() as $id => $qtd) {
        $produtoCarrinho = $this->produtoModel->find('id', $id);

        // 🔍 Verifica se o produto existe
        if (!$produtoCarrinho) {
            continue;
        }

        $valorProduto = ($produtoCarrinho->produto_promocao == 1)
            ? $produtoCarrinho->produto_valor_promocao
            : $produtoCarrinho->produto_valor;

        $total += $valorProduto * $qtd;
    }

    return $total;
}

}
