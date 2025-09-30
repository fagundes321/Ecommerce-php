<?php

namespace App\Classes;

/**
 * Classe responsável por gerenciar e verificar o status do carrinho de compras.
 */
class StatusCarrinho
{
    /**
     * Verifica se o carrinho já existe na sessão.
     *
     * @return bool
     */
    public function carrinhoExiste()
    {
        return isset($_SESSION['carrinho']);
    }

    /**
     * Cria o carrinho na sessão, caso não exista.
     *
     * @return array Carrinho criado ou já existente
     */
    public function criarCarrinho()
    {
        if (!$this->carrinhoExiste()) {
            $_SESSION['carrinho'] = [];
        }
        return $_SESSION['carrinho'];
    }

    /**
     * Verifica se um produto já está no carrinho.
     *
     * @param int|string $id ID do produto
     * @return bool
     */
    public function produtoEstaNoCarrinho($id)
    {
        return isset($_SESSION['carrinho'][$id]);
    }

    /**
     * Retorna o carrinho atual da sessão.
     *
     * @return array
     */
    public function carrinho()
    {
        return $_SESSION['carrinho'];
    }
}

