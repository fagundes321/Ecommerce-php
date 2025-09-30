<?php

namespace App\Models\Database\TypeDatabase;

use App\Interfaces\InterfaceTypeDatabase;
use App\Models\Database\ConnectDatabase\Connection;
use App\Models\Database\ConnectDatabase\ConnectPdoDatabase;

/**
 * Classe TypePdoDatabase
 * 
 * Implementa InterfaceTypeDatabase usando PDO.
 * 
 * Funcionalidade:
 * - Prepara, vincula valores e executa queries via PDO
 * - Retorna resultados padronizados (fetch/fetchAll)
 * - Permite abstração para repositórios sem depender diretamente do PDO
 */
class TypePdoDatabase implements InterfaceTypeDatabase
{
    /**
     * @var \PDO Instância da conexão PDO
     */
    private $pdo;

    /**
     * @var \PDOStatement Objeto do statement preparado
     */
    private $objectPdo;

    /**
     * Construtor.
     * - Inicializa a conexão PDO via Connection
     */
    public function __construct()
    {
        $pdo = new Connection(new ConnectPdoDatabase);
        $this->pdo = $pdo->connectDatabase();
    }

    /**
     * Prepara a query SQL.
     * 
     * @param string $sql
     */
    public function prepare($sql)
    {
        $this->objectPdo = $this->pdo->prepare($sql);
    }

    /**
     * Faz bind de valores aos parâmetros da query.
     * 
     * @param string $key
     * @param mixed $value
     */
    public function bindValue($key, $value)
    {
        $this->objectPdo->bindValue($key, $value);
    }

    /**
     * Executa o comando SQL preparado.
     */
    public function execute()
    {
        $this->objectPdo->execute();
    }

    /**
     * Retorna o número de linhas afetadas.
     * 
     * @return int
     */
    public function rowCount()
    {
        return $this->objectPdo->rowCount();
    }

    /**
     * Retorna uma linha do resultado da consulta.
     * 
     * @return mixed
     */
    public function fetch()
    {
        return $this->objectPdo->fetch();
    }

    /**
     * Retorna todas as linhas do resultado da consulta.
     * 
     * @return array
     */
    public function fetchAll()
    {
        return $this->objectPdo->fetchAll();
    }
}
