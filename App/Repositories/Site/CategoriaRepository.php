<?php 

namespace App\Repositories\Site;

use App\Models\Site\CategoriaModel;

class CategoriaRepository{
    private $categoria;

    public function __construct()
    {
        $this->categoria =  new CategoriaModel;
    }

    public function listarCategoriasProdutos(){
        // $sql = "SELECT 
        //             categorias.id,
        //             categorias.categoria_nome,
        //             categorias.categoria_slug,
        //             COUNT(produtos.id) as total_produtos,
        //             MIN(produtos.produto_valor) as preco_minimo,
        //             MAX(produtos.produto_valor) as preco_maximo
        //         FROM {$this->categoria->table} 
        //         INNER JOIN produtos ON (categorias.id = produtos.produto_categoria) 
        //         GROUP BY categorias.id, categorias.categoria_nome, categorias.categoria_slug";
        
        $sql = "select categoria_slug, categoria_nome from {$this->categoria->table} group by categorias.id";

        $this->categoria->typeDatabase->prepare($sql);
        $this->categoria->typeDatabase->execute();
        return $this->categoria->typeDatabase->fetchAll();
    }
}