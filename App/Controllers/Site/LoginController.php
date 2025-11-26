<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Login;
use App\Classes\Filters;
use App\Models\Site\UserLogin;

class LoginController extends BaseController
{

    public function index()
    {

        $dados = [
            'titulo' => 'InovaTech | Loja Virtual',
            'nome'   => 'Victor',

        ];


        echo $this->twig->render('site_login.html', $dados);
    }

    public function logar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $filter = new Filters();

            $email = $filter->filter('email', 'string');
            $password = $filter->filter('password', 'string');

            $login = new Login();
            $login->setEmail($_POST['email']);
            $login->setPassword($_POST['password']);

            if($login->logar(new userLogin())){
                header('location:/');
            }
           header('location:/asf');
        }
        // header('location:/');
    }
}
