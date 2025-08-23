<?php

namespace App\Models\Database\TypeDatabase;

use App\Interfaces\InterfaceTypeDatabase;
use App\Models\Database\ConnectDatabase\Connection;
use App\Models\Database\ConnectDatabase\ConnectPdoDatabase;

class TypePdoDatabase implements InterfaceTypeDatabase
{
    private $pdo;        // Objeto da conexão PDO
    private $objectPdo;  // Objeto PDOStatement (resultado do prepare)

    public function __construct()
    {
        // Cria a conexão PDO usando a classe Connection
        $pdo = new Connection(new ConnectPdoDatabase);
        $this->pdo = $pdo->connectDatabase();
    }

    public function prepare($sql)
    {
        // Prepara o comando SQL (retorna PDOStatement)
        // Ex: SELECT * FROM tabela WHERE id = :id
        $this->objectPdo = $this->pdo->prepare($sql);
    }

    public function bindValue($key, $value)
    {
        // Faz a associação de valores aos parâmetros do SQL
        // Ex: :id → 10
        $this->objectPdo->bindValue($key, $value);
    }

    public function execute()
    {
        // Executa o comando SQL preparado
        // Pode ser SELECT, INSERT, UPDATE ou DELETE
        $this->objectPdo->execute();
    }

    public function rowCount()
    {
        // Retorna quantas linhas foram afetadas
        // Em SELECT → número de linhas retornadas
        // Em INSERT/UPDATE/DELETE → número de linhas modificadas
        return $this->objectPdo->rowCount();
    }

    public function fetch()
    {
        // Retorna apenas uma linha do resultado da consulta
        // Normalmente usado quando espera-se apenas um registro
        return $this->objectPdo->fetch();
    }

    public function fetchAll()
    {
        // Retorna todas as linhas do resultado da consulta em array
        // Normalmente usado em listagens
        return $this->objectPdo->fetchAll();
    }
}
