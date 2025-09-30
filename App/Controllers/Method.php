<?php

namespace App\Controllers;

use App\Classes\Uri;

/**
 * Classe responsável por identificar o método que deve ser executado em um controller.
 * 
 * Funcionalidade:
 * - Lê a URI atual
 * - Determina qual método do controller deve ser chamado
 * - Verifica se o método realmente existe no controller
 * - Caso não exista, retorna o método padrão definido em DEFAULT_METHOD
 */
class Method
{
    /**
     * @var Uri Instância da classe Uri
     */
    private $uri;

    public function __construct()
    {
        $this->uri = new Uri;
    }

    /**
     * Retorna o método solicitado pela URI.
     * 
     * - A URI é esperada no formato: /controller/method/parametros
     * - Pega o terceiro segmento da URI (índice 2)
     * 
     * @return string|null
     */
    private function getMethod()
    {
        if (!$this->uri->emptyUri()) {
            $explodeUri = array_filter(explode('/', $this->uri->getUri()));
            return $explodeUri[2] ?? null;
        }

        return null;
    }
    
    /**
     * Retorna o método válido do controller.
     * - Se o método existe no objeto passado, retorna ele
     * - Caso contrário, retorna o método padrão (DEFAULT_METHOD)
     * 
     * @param object $object Controller onde o método será chamado
     * @return string
     */
    public function method($object): string
    {
        $method = $this->getMethod();

        if ($method && method_exists($object, $method)) {
            return $method;
        }

        return DEFAULT_METHOD;
    }
}
