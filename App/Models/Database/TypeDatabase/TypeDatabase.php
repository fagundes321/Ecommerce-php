<?php

namespace App\Models\Database\TypeDatabase;

use App\Interfaces\InterfaceTypeDatabase;

/**
 * Classe TypeDatabase
 * 
 * Responsável por encapsular a implementação concreta da InterfaceTypeDatabase.
 * 
 * Funcionalidade:
 * - Recebe uma implementação concreta (PDO ou MySQLi) via injeção de dependência
 * - Permite acessar os métodos de manipulação do banco de dados através da interface
 */
class TypeDatabase
{
    /**
     * @var InterfaceTypeDatabase Instância da implementação concreta da interface
     */
    private $interfaceTypeDatabase;

    /**
     * Construtor.
     * - Recebe a implementação concreta via injeção de dependência
     * 
     * @param InterfaceTypeDatabase $interfaceTypeDatabase
     */
    public function __construct(InterfaceTypeDatabase $interfaceTypeDatabase)
    {
        $this->interfaceTypeDatabase = $interfaceTypeDatabase;
    }

    /**
     * Retorna a instância da implementação concreta da interface.
     * 
     * @return InterfaceTypeDatabase
     */
    public function getDatabase()
    {
        return $this->interfaceTypeDatabase;
    }
}
