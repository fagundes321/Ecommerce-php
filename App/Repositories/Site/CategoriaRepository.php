<?php 

namespace App\Repositories\Site;

use App\Models\Site\CategoriaModel;

/**
 * Classe CategoriaRepository
 * 
 * Responsável por lidar com operações específicas de categoria,
 * mantendo a lógica de acesso a dados separada do Model.
 */
class CategoriaRepository
{
    /**
     * @var CategoriaModel Instância do modelo de categorias
     */
    private $categoria;

    /**
     * Construtor
     * Inicializa o modelo
     */
    public function __construct()
    {
        $this->categoria = new CategoriaModel;
    }

    /**
     * Lista todas as categorias de produtos
     * 
     * @return array
     */
    public function listarCategoriasProdutos()
    {
        // Monta a query para pegar slug e nome das categorias
        $sql = "SELECT categoria_slug, categoria_nome 
                FROM {$this->categoria->table} 
                GROUP BY {$this->categoria->table}.id"; // garante compatibilidade com alias do schema

        // Prepara e executa a query
        $this->categoria->typeDatabase->prepare($sql);
        $this->categoria->typeDatabase->execute();

        // Retorna todos os resultados
        return $this->categoria->typeDatabase->fetchAll();
    }
}
