<?php

namespace App\Models\Database\TypeDatabase;

use App\Interfaces\InterfaceTypeDatabase;
use App\Models\Database\ConnectDatabase\Connection;
use App\Models\Database\ConnectDatabase\ConnectMysqliDatabase;

/**
 * Classe TypeMysqliDatabase
 * 
 * Implementa InterfaceTypeDatabase usando MySQLi.
 * Funcionalidade:
 * - Prepara, vincula valores e executa queries
 * - Retorna resultados de forma padronizada
 * - Serve como camada de abstração para manipulação do banco via MySQLi
 */
class TypeMysqliDatabase implements InterfaceTypeDatabase
{
    /**
     * @var \mysqli Instância da conexão MySQLi
     */
    private $mysqli;

    /**
     * @var \mysqli_stmt Instância do statement preparado
     */
    private $objectMysqli;

    /**
     * Construtor.
     * Inicializa a conexão com o banco via Connection + ConnectMysqliDatabase
     */
    public function __construct()
    {
        $mysqli = new Connection(new ConnectMysqliDatabase);
        $this->mysqli = $mysqli->connectDatabase();
    }

    /**
     * Prepara a query SQL.
     * 
     * @param string $sql
     */
    public function prepare($sql)
    {
        $this->objectMysqli = $this->mysqli->prepare($sql);
    }

    /**
     * Faz bind de valores aos parâmetros da query.
     * 
     * @param string|int $key
     * @param mixed $value
     */
    public function bindValue($key, $value)
    {
        $type = match (gettype($value)) {
            'integer' => 'i',
            'double'  => 'd',
            'string'  => 's',
            default   => 'b'
        };

        $this->objectMysqli->bind_param($type, $value);
    }

    /**
     * Executa a query preparada.
     * 
     * @return bool
     */
    public function execute()
    {
        return $this->objectMysqli->execute();
    }

    /**
     * Retorna o número de linhas afetadas.
     * 
     * @return int
     */
    public function rowCount()
    {
        return $this->objectMysqli->num_rows;
    }

    /**
     * Retorna a primeira linha do resultado como objeto.
     * 
     * @return object|null
     */
    public function fetch()
    {
        return $this->objectMysqli->get_result()->fetch_object();
    }

    /**
     * Retorna todas as linhas do resultado como array associativo.
     * 
     * @return array
     */
    public function fetchAll()
    {
        $data = [];
        $result = $this->objectMysqli->get_result();

        while ($resultFetch = $result->fetch_assoc()) {
            $data[] = $resultFetch;
        }

        return $data;
    }
}
