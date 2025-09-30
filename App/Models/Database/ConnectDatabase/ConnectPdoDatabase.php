<?php 

namespace App\Models\Database\ConnectDatabase;

use App\Interfaces\InterfaceConnectDatabase;
use PDO;
use PDOException;

/**
 * Classe ConnectPdoDatabase
 * 
 * Implementa a interface InterfaceConnectDatabase usando PDO.
 * 
 * Funcionalidade:
 * - Conecta ao banco de dados MySQL via PDO
 * - Configura fetch padrão como objeto
 * - Configura o PDO para lançar exceções em caso de erro
 */
class ConnectPdoDatabase implements InterfaceConnectDatabase
{
    /**
     * @var PDO Instância da conexão PDO
     */
    private $pdo;

    /**
     * Construtor.
     * - Inicializa a conexão com o banco de dados
     * - Captura erros e encerra execução caso haja falha
     */
    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                "mysql:host=mysql-db;dbname=ecommerce;charset=utf8mb4", // DSN
                "db_user",  // usuário
                "123"       // senha
            );

            // Define fetch padrão como objeto
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            
            // Define modo de erro para exceções
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão com o banco: " . $e->getMessage());
        }
    }

    /**
     * Retorna a instância da conexão PDO.
     * 
     * @return PDO
     */
    public function connectDatabase()
    {
        return $this->pdo;
    }
}
