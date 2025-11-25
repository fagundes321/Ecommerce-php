<?php 

namespace App\Controllers\Site;

use App\Controllers\BaseController;

class LoginController extends BaseController{

    public function index(){
              $dados = [
            'titulo' => 'InovaTech | Loja Virtual',
            'nome'   => 'Victor',
          
        ];

      
        echo $this->twig->render('site_login.html', $dados);
    }

    public function logar(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            dump('logar');
            die();
        }
        header('location:/');
    }

}