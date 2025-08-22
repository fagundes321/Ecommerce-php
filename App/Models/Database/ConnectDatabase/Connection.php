<?php 

namespace App\Models\Database\ConnectDatabase;

use App\Interfaces\InterfaceConnectDatabase;


class Connection{

    private $interfaceConnectDatabase;

    public function __construct(InterfaceConnectDatabase $interfaceConnectDatabase)
    {
        $this->interfaceConnectDatabase = $interfaceConnectDatabase;
        $this->interfaceConnectDatabase = new ConnectPdoDatabase;
    }

    public function connectDatabase(){
        return $this->interfaceConnectDatabase->connectDatabase();
    }
}