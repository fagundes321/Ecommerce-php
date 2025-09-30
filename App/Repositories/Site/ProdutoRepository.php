<?php

namespace App\Repositories\Site;

use App\Models\Site\ProdutoModel;

/**
 * Classe ProdutoRepository
 * 
 * Responsável por operações específicas de produtos.
 * Mantém a lógica de acesso ao banco separada do Model.
 */
class ProdutoRepository
{
    /**
     * @var ProdutoModel Instância do modelo de produtos
     */
    private $produto;

    /**
     * Construtor
     * Inicializa o modelo
     */
    public function __construct()
    {
        $this->produto = new ProdutoModel;
    }

    /**
     * Retorna os produtos mais recentes
     * 
     * @return array
     */
    public function ultimoProdutoAdicionado()
    {
        $sql = "SELECT * FROM {$this->produto->table} ORDER BY id DESC";
        $this->produto->typeDatabase->prepare($sql);
        $this->produto->typeDatabase->execute();
        return $this->produto->typeDatabase->fetchAll();
    }

    /**
     * Lista produtos em destaque, limitado pela quantidade
     * 
     * @param int $limite
     * @return array
     */
    public function listarProdutosOrdenadosPeloDestaque($limite)
    {
        $sql = "SELECT * FROM {$this->produto->table} 
                ORDER BY produto_destaque = 1 DESC 
                LIMIT {$limite}";
        $this->produto->typeDatabase->prepare($sql);
        $this->produto->typeDatabase->execute();
        return $this->produto->typeDatabase->fetchAll();
    }

    /**
     * Lista produtos em promoção
     * 
     * @return array
     */
    public function listarProdutosOrdenadosPelaPromocao()
    {
        $sql = "SELECT * FROM {$this->produto->table} 
                ORDER BY produto_promocao = 1 DESC";
        $this->produto->typeDatabase->prepare($sql);
        $this->produto->typeDatabase->execute();
        return $this->produto->typeDatabase->fetchAll();
    }

    /**
     * Busca produtos pelo nome ou descrição
     * 
     * @param string $busca
     * @return array
     */
    public function buscarProduto($busca)
    {
        $sql = "SELECT * FROM {$this->produto->table} 
                WHERE produto_nome LIKE ? OR produto_descricao LIKE ?";
        $this->produto->typeDatabase->prepare($sql);
        $this->produto->typeDatabase->bindValue(1, "%{$busca}%");
        $this->produto->typeDatabase->bindValue(2, "%{$busca}%");
        $this->produto->typeDatabase->execute();
        return $this->produto->typeDatabase->fetchAll();
    }
}
