<?php 

namespace App\Models\Site;

use App\Models\Model;

/**
 * Classe UserModel
 * 
 * Responsável por interagir com a tabela 'users' no banco de dados.
 * 
 * Funcionalidade:
 * - Define a tabela a ser utilizada pelo Model base
 * - Permite herdar métodos de CRUD do Model
 */
class UserModel extends Model
{
    /**
     * @var string Nome da tabela no banco de dados
     * Inclui o schema 'ecommerce' caso seja necessário
     */
    public $table = "ecommerce.users";
}
