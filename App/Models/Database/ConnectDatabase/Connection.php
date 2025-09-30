<?php 

namespace App\Models\Database\ConnectDatabase;

use App\Interfaces\InterfaceConnectDatabase;

/**
 * Classe Connection
 * 
 * Responsável por fornecer a conexão com o banco de dados
 * usando a implementação da interface InterfaceConnectDatabase.
 * 
 * Funcionalidade:
 * - Recebe a implementação concreta da interface via injeção de dependência
 * - Expõe método connectDatabase() para retornar a conexão
 */
class Connection
{
    /**
     * @var InterfaceConnectDatabase Implementação concreta da interface de conexão
     */
    private $interfaceConnectDatabase;

    /**
     * Construtor.
     * 
     * @param InterfaceConnectDatabase $interfaceConnectDatabase
     */
    public function __construct(InterfaceConnectDatabase $interfaceConnectDatabase)
    {
        // Armazena a instância injetada (não criar diretamente aqui!)
        $this->interfaceConnectDatabase = $interfaceConnectDatabase;
    }

    /**
     * Retorna a conexão com o banco de dados.
     * 
     * @return mixed
     */
    public function connectDatabase()
    {
        return $this->interfaceConnectDatabase->connectDatabase();
    }
}
