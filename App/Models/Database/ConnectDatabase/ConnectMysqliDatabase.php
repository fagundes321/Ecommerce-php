<?php

namespace App\Models\Database\ConnectDatabase;

use App\Interfaces\InterfaceConnectDatabase;



class ConnectMysqliDatabase implements InterfaceConnectDatabase
{

    private $mysqli;

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

    public function connectDatabase()
    {
        return $this->mysqli;
    }
}
