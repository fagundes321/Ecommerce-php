<?php 

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Models\Site\ProdutoModel;
use App\Models\Site\CategoriaModel;

class CategoriaController extends BaseController{

    public function index($params)
    {
        $categoriaModel = new CategoriaModel;
        $categoriaEncontrada = $categoriaModel->find('categoria_slug', $params[0]);
        dump($categoriaEncontrada);

    }

}