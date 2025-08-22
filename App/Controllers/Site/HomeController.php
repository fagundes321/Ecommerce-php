<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Models\Site\UserModel;

class HomeController extends BaseController
{
    public function index()
    {
        // $dados = [
        //     'titulo' => 'InovaTech | Loja Virtual',
        //     'nome'  => 'Victor'
        // ];

        // Forma 1: simples (recomendada)
        // echo $this->twig->render('site_home.html', $dados);

        // Forma 2: se quiser carregar e depois renderizar
        // $template = $this->twig->load('site_home.html');
        // echo $template->render($dados);

        $user = new UserModel;
        dump($user->fetchAll());
        
    }
}
