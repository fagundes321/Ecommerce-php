<?php 

namespace App\Controllers;

use App\Classes\Uri;

class Controller{

    const NAMESPACE_CONTROLLER = '\\App\\Controllers\\';
    const FOLDERS_CONTROLLER =  ['Site', 'Admin'];
    const ERROR_CONTROLLER = '\\App\\Controllers\\Erro\\ErroController';


    private $controller;
    private $uri;

    public function __construct()
    {
        $this->uri = new Uri;
    }

    public function getController(){
        if (!$this->uri->emptyUri()){
            $explodeUri = array_filter(explode('/', $this->uri->getUri()));

            // aqui deixo a primeira letra maiuscula e pega a primeira parte da URI
            return ucfirst($explodeUri[1].'Controller');
        }

        return ucfirst(DEFAULT_CONTROLLER).'Controller';
    }

    public function controller(){
        $controller = $this->getController();

        foreach (self::FOLDERS_CONTROLLER as $folderController) {
            if (class_exists(self::NAMESPACE_CONTROLLER.$folderController.'\\'.$controller)) {
                return self::NAMESPACE_CONTROLLER.$folderController.'\\'.$controller;
            }
        }
        // caso não tiver nenhuma controller ele cospe erro
        return self::ERROR_CONTROLLER;
    }
}