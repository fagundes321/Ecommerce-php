<?php 

namespace App\Models\Database\ConnectDatabase;

use App\Interfaces\InterfaceConnectDatabase;
use PDO;
use PDOException;



class ConnectPdoDatabase implements InterfaceConnectDatabase{

    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                "mysql:host=mysql-db;dbname=ecommerce;charset=utf8",
                "db_user",
                "123"
            );
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão com o banco: " . $e->getMessage());
        }
    }

    public function connectDatabase()
    {
        return $this->pdo;
    }
}
