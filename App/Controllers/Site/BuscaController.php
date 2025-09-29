<?php 

namespace App\Controllers\Site;

use App\Controllers\BaseController;

class BuscaController extends BaseController{

    public function index(){

        $produto = filter_input(INPUT_GET, 'b', FILTER_SANITIZE_SPECIAL_CHARS);
        
    }

}