<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Login;
use App\Classes\Filters;
use App\Models\Site\UserLogin;
use App\Classes\Redirect;
use App\Classes\Logado;

class LoginController extends BaseController
{
    private $redirect;


    public function __construct()
    {
        $this->redirect = new Redirect();
    }

    public function index()
    {
        $logado = new Logado();

        if($logado->logado()){
            $this->redirect->redirect("/");
        }
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

            if ($login->logar(new userLogin())) {
                return $this->redirect->redirect('/');
            } else {
                return $this->redirect->redirect('/login');
            }
            return $redirect->redirect('/');
        }
    }

    public function logout(){
        $redirect = new Redirect;
        unset( $_SESSION['id'] );
        unset( $_SESSION['name'] );
        unset( $_SESSION['logado'] );
        // unset($_SESSION['carrinho']);
        // session_destroy();
        return $redirect->redirect('/');
    }
}
