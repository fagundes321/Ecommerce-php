<?php 

namespace App\Controllers\Site;

use App\Controllers\BaseController;

class FreteController extends BaseController{

    public function calcular(){
        echo json_encode('Calcular frete');
    }

}