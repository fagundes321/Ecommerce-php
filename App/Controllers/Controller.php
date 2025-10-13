<?php

namespace App\Controllers;

use App\Classes\Uri;

/**
 * Classe responsável por mapear a URI para o controller correto.
 * 
 * Funcionalidade:
 * - Lê a URI atual
 * - Determina qual controller deve ser chamado
 * - Verifica se a classe existe nos diretórios definidos (Site/Admin)
 * - Caso não exista, retorna o controller de erro
 */
class Controller
{
    // Namespace base dos controllers
    const NAMESPACE_CONTROLLER = '\\App\\Controllers\\';

    // Diretórios onde os controllers podem estar
    const FOLDERS_CONTROLLER = ['Site', 'Admin'];

    // Controller padrão de erro caso não encontre a classe
    const ERROR_CONTROLLER = '\\App\\Controllers\\Erro\\ErroController';

    /**
     * @var string Nome do controller atual
     */
    private $controller;

    /**
     * @var Uri Instância da classe Uri
     */
    private $uri;

    public function __construct()
    {
        $this->uri = new Uri;
    }

    /**
     * Retorna o nome do controller baseado na URI.
     * - Se a URI estiver vazia, retorna o controller padrão.
     * - Se a URI tiver um segmento, transforma a primeira letra em maiúscula e adiciona "Controller".
     * 
     * @return string
     */
    public function getController()
    {
        if (!$this->uri->emptyUri()) {
            $explodeUri = array_filter(explode('/', $this->uri->getUri()));

            // Pega a primeira parte significativa da URI e formata
            return ucfirst($explodeUri[1] . 'Controller');
        }

        // Caso a URI esteja vazia, retorna o controller padrão definido em DEFAULT_CONTROLLER
        return ucfirst(DEFAULT_CONTROLLER) . 'Controller';
    }

    /**
     * Retorna a classe completa do controller existente.
     * - Verifica nos diretórios definidos (Site, Admin)
     * - Caso não encontre, retorna o controller de erro
     * 
     * @return string
     */
    public function controller()
    {
        $controller = $this->getController();

        foreach (self::FOLDERS_CONTROLLER as $folderController) {
            if (class_exists(self::NAMESPACE_CONTROLLER . $folderController . '\\' . $controller)) {
                return self::NAMESPACE_CONTROLLER . $folderController . '\\' . $controller;
            }
        }

        // Caso não encontre nenhum controller válido, retorna o controller de erro
        return self::ERROR_CONTROLLER;
    }
}
