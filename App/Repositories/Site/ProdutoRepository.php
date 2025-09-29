<?php

namespace App\Repositories\Site;

use App\Models\Site\ProdutoModel;


class ProdutoRepository
{

    private $produto;

    public function __construct()
    {
        $this->produto = new ProdutoModel;
    }

    public function ultimoProdutoAdicionado()
    {
        $sql = "SELECT * FROM  {$this->produto->table} ORDER BY id DESC ";
        $this->produto->typeDatabase->prepare($sql);
        $this->produto->typeDatabase->execute();
        return $this->produto->typeDatabase->fetchAll();
    }

    public function listarProdutosOrdenadosPeloDestaque($limite)
    {
        $sql = "SELECT * FROM  {$this->produto->table} ORDER BY produto_destaque = 1 DESC LIMIT {$limite}";
        $this->produto->typeDatabase->prepare($sql);
        $this->produto->typeDatabase->execute();
        return $this->produto->typeDatabase->fetchAll();
    }

    public function listarProdutosOrdenadosPelaPromocao()
    {
        $sql = "SELECT * FROM  {$this->produto->table} ORDER BY produto_destaque = 1 DESC ";
        $this->produto->typeDatabase->prepare($sql);
        $this->produto->typeDatabase->execute();
        return $this->produto->typeDatabase->fetchAll();
    }

    // Buscar Produto
    public function buscarProduto($busca){
        $sql = "SELECT * FROM {$this->produto->table} WHERE produto_nome LIKE ? OR produto_descricao LIKE ?";
        $this->produto->typeDatabase->prepare($sql);
        $this->produto->typeDatabase->bindValue(1, "%".$busca."%");
        $this->produto->typeDatabase->bindValue(2, "%".$busca."%");
        $this->produto->typeDatabase->execute();
        return $this->produto->typeDatabase->fetchAll();
    }
}
