<?php 

namespace App\Models\Site;

use App\Models\Model;

/**
 * Classe CategoriaModel
 * 
 * Responsável por interagir com a tabela 'categorias' no banco de dados.
 * 
 * Funcionalidade:
 * - Define a tabela a ser utilizada pelo Model base
 * - Permite herdar métodos de CRUD do Model
 */
class CategoriaModel extends Model
{
    /**
     * @var string Nome da tabela no banco de dados
     */
    public $table = 'categorias';
}
