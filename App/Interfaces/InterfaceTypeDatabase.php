<?php 

namespace App\Interfaces;

/**
 * InterfaceTypeDatabase
 * 
 * Interface que define o contrato para classes que manipulam operações de banco de dados.
 * 
 * Qual a utilidade?
 * - Garante que qualquer classe que implemente esta interface terá métodos essenciais
 *   para preparar e executar consultas, bem como retornar resultados.
 */
interface InterfaceTypeDatabase
{
    /**
     * Prepara uma consulta SQL para execução.
     * 
     * @param string $sql
     * @return mixed
     */
    public function prepare($sql);

    /**
     * Faz o bind de valores aos parâmetros da query preparada.
     * 
     * @param string|int $key
     * @param mixed $value
     */
    public function bindValue($key, $value);

    /**
     * Executa a consulta preparada.
     * 
     * @return bool
     */
    public function execute();

    /**
     * Retorna a quantidade de linhas afetadas pela última operação.
     * 
     * @return int
     */
    public function rowCount();

    /**
     * Retorna a próxima linha do resultado como array ou objeto.
     * 
     * @return mixed
     */
    public function fetch();

    /**
     * Retorna todas as linhas do resultado como array ou objeto.
     * 
     * @return array
     */
    public function fetchAll();
}
