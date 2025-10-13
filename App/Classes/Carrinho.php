<?php

namespace App\Classes;

use App\Classes\StatusCarrinho;

/**
 * Classe responsável por gerenciar as operações do carrinho de compras
 * 
 * Funcionalidades:
 * - Adicionar produtos
 * - Atualizar quantidade
 * - Remover produtos
 * - Limpar carrinho
 * - Consultar produtos no carrinho
 */
class Carrinho
{
    /**
     * Objeto da classe StatusCarrinho
     * Permite verificar se o carrinho existe e se um produto já está nele
     */
    private $statusCarrinho;

    public function __construct()
    {
        // Cria o objeto StatusCarrinho e garante que o carrinho exista na sessão
        $this->statusCarrinho = new StatusCarrinho();
        $this->statusCarrinho->criarCarrinho();
    }

    /**
     * Adiciona um produto ao carrinho
     * Se o produto já existir, incrementa a quantidade
     */
    public function add($id)
    {
        if ($this->statusCarrinho->produtoEstaNoCarrinho($id)) {
            // Produto já existe → adiciona 1 unidade
            $_SESSION['carrinho'][$id]+=1;
        } else {
            // Produto não existe → adiciona 1 unidade
            $_SESSION['carrinho'][$id]=1;
        }
    }

    /**
     * Retorna a quantidade de um produto específico no carrinho
     */
    public function produtoCarrinho($id)
    {
        
        return $_SESSION['carrinho'][$id];
    }

    /**
     * Atualiza a quantidade de um produto no carrinho
     * Só atualiza se o produto já estiver presente
     */
    public function update($id, $qtd)
    {
        if ($this->statusCarrinho->produtoEstaNoCarrinho($id)) {
            $_SESSION['carrinho'][$id] = $qtd;
        }
    }

    /**
     * Remove um produto do carrinho
     */
    public function remove($id)
    {
        if($this->statusCarrinho->produtoEstaNoCarrinho($id)){
            unset($_SESSION['carrinho'][$id]);
        }
    }

    /**
     * Limpa todo o carrinho
     */
    public function clear()
    {
        if($this->statusCarrinho->carrinhoExiste()){
            unset($_SESSION['carrinho']);
        }
    }

    /**
     * Retorna todos os produtos do carrinho
     */
    public function produtosCarrinho()
    {
       if($this->statusCarrinho->carrinhoExiste()){
        return $this->statusCarrinho->carrinho();
       }
       return [];
    }
}
