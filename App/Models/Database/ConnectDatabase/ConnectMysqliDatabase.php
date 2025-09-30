<?php

namespace App\Models\Database\ConnectDatabase;

use App\Interfaces\InterfaceConnectDatabase;

/**
 * Classe ConnectMysqliDatabase
 * 
 * Implementa a interface InterfaceConnectDatabase usando MySQLi.
 * 
 * Funcionalidade:
 * - Conecta ao banco de dados MySQL usando mysqli
 * - Retorna a instância da conexão
 */
class ConnectMysqliDatabase implements InterfaceConnectDatabase
{
    /**
     * @var \mysqli Instância da conexão MySQLi
     */
    private $mysqli;

    /**
     * Construtor.
     * - Inicializa a conexão com o banco de dados
     * - Termina a execução caso haja erro na conexão
     */
    public function __construct()
    {
        $this->mysqli = new \mysqli(
            "mysql-db",   // host = nome do serviço no docker-compose
            "db_user",    // usuário
            "123",        // senha
            "ecommerce",  // banco de dados
            3306          // porta (padrão do MySQL)
        );
       
        if ($this->mysqli->connect_error) {
            die("Erro na conexão MySQLi: " . $this->mysqli->connect_error);
        }
    }

    /**
     * Retorna a instância da conexão MySQLi.
     * 
     * @return \mysqli
     */
    public function connectDatabase()
    {
        return $this->mysqli;
    }
}
