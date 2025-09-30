<?php 

namespace App\Interfaces;

/**
 * InterfaceConnectDatabase
 * 
 * Interface que define o contrato para classes responsáveis por conectar-se ao banco de dados.
 * 
 * Qual a utilidade?
 * - Garante que qualquer classe que implemente essa interface terá o método `connectDatabase()`.
 */
interface InterfaceConnectDatabase
{
    /**
     * Método obrigatório para estabelecer a conexão com o banco de dados.
     * Deve ser implementado por todas as classes que usam esta interface.
     * 
     * @return mixed Retorno da implementação de conexão (ex: PDO, mysqli, etc)
     */
    public function connectDatabase();
}
