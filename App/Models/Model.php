<?php

namespace App\Models;

use App\Models\Database\ConnectDatabase\ConnectPdoDatabase;
use App\Models\Database\TypeDatabase\TypeDatabase;
use App\Models\Database\TypeDatabase\TypePdoDatabase;

/**
 * Classe Model
 * 
 * Responsável por fornecer métodos básicos de CRUD para as classes que herdam dela.
 * Funcionalidade:
 * - Conecta ao banco via TypeDatabase (PDO ou MySQLi)
 * - Permite executar consultas genéricas
 * - Pode ser estendido por modelos específicos (ProdutoModel, UserModel, etc.)
 */
class Model
{
    /**
     * @var TypePdoDatabase Instância da implementação de TypeDatabase
     */
    public $typeDatabase;

    /**
     * Construtor
     * Inicializa a conexão com o banco via TypeDatabase (PDO atualmente)
     */
    public function __construct()
    {
        $database = new TypeDatabase(new TypePdoDatabase);
        $this->typeDatabase = $database->getDatabase();
    }

    /**
     * Retorna todos os registros da tabela
     * 
     * @return array
     */
    public function fetchAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        $this->typeDatabase->prepare($sql);
        $this->typeDatabase->execute();

        return $this->typeDatabase->fetchAll();
    }

    /**
     * Busca registros filtrando por um campo específico
     * 
     * @param string $field Campo da tabela
     * @param mixed $value Valor a ser buscado
     * @param bool|null $fetch null retorna apenas 1 registro, true retorna todos
     * @return mixed
     */
    public function find($field, $value, $fetch = null)
    {
        $sql = "SELECT * FROM {$this->table} WHERE $field = ?";
        $this->typeDatabase->prepare($sql);
        $this->typeDatabase->bindValue(1, $value);
        $this->typeDatabase->execute();

        return ($fetch == null) ? $this->typeDatabase->fetch() : $this->typeDatabase->fetchAll();
    }
}
