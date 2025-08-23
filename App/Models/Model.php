<?php

namespace App\Models;

use App\Models\Database\ConnectDatabase\ConnectPdoDatabase;
use App\Models\Database\ConnectDatabase\ConnectMysqliDatabase;
use App\Models\Database\TypeDatabase\TypeDatabase;
use App\Models\Database\TypeDatabase\TypePdoDatabase;

class Model
{

    public $typeDatabase;

    public function __construct()
    {

        $database = new TypeDatabase(new TypePdoDatabase);
        $this->typeDatabase = $database->getDatabase();
    }

    public function fetchAll()
    {


        $sql = "SELECT * FROM {$this->table}";
        $this->typeDatabase->prepare($sql);
        $this->typeDatabase->execute();
        return $this->typeDatabase->fetchAll();
    }

    // select * from produtor where categoria = 1
    public function find($field, $value, $fetch = null)
    {

        $sql = "SELECT * FROM {$this->table} where $field = ?";
        $this->typeDatabase->prepare($sql);
        $this->typeDatabase->bindValue(1, $value);
        $this->typeDatabase->execute();

        return ($fetch == null) ? $this->typeDatabase->fetch() : $this->typeDatabase->fetchAll();
    }
}
