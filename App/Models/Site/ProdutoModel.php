<?php 

namespace App\Models\Site;

use App\Models\Model;

/**
 * Classe ProdutoModel
 * 
 * Responsável por interagir com a tabela 'produtos' no banco de dados.
 * 
 * Funcionalidade:
 * - Define a tabela a ser utilizada pelo Model base
 * - Permite herdar métodos de CRUD do Model
 */
class ProdutoModel extends Model
{
    /**
     * @var string Nome da tabela no banco de dados
     * Inclui o schema 'ecommerce' caso seja necessário
     */
    public $table = 'ecommerce.produtos';
}
