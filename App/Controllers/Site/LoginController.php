<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Login;
use App\Classes\Filters;
use App\Models\Site\UserLogin;
use App\Classes\Redirect;

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
            $redirect = new Redirect;

            $email = $filter->filter('email', 'string');
            $password = $filter->filter('password', 'string');

            $login = new Login();
            $login->setEmail($_POST['email']);
            $login->setPassword($_POST['password']);

            if ($login->logar(new userLogin())) {
                return $redirect->redirect('/');
            } else {
                return $redirect->redirect('/login');
            }
            return $redirect->redirect('/');
        }
    }

    public function logout(){
        $redirect = new Redirect;
        unset( $_SESSION['logado'] );
        unset($_SESSION['carrinho']);
        return $redirect->redirect('/');
    }
}
