<?php

namespace App\Classes;

use App\Classes\Uri;

/**
 * Classe responsável por extrair os parâmetros da URI atual.
 * 
 * Exemplo:
 *  - URI: /produto/123/detalhes
 *  - Resultado: ['produto', '123', 'detalhes']
 */
class Parameters
{
    /**
     * @var string URI atual
     */
    private $uri;

    /**
     * @var array Parâmetros extraídos da URI
     */
    private $parameter;

    public function __construct()
    {
        $uri = new Uri();
        $this->uri = $uri->getUri();
    }

    /**
     * Divide a URI em segmentos e retorna os parâmetros.
     *
     * @return array Lista de parâmetros renumerados
     */
    private function explodeParameters()
    {
        $explodeUri = explode('/', $this->uri);
        // Remove valores vazios e renumera os índices
        $this->parameter = array_filter($explodeUri);
            //  dump($this->parameter);
        // return $this->parameter;
    }

    public function getParameterMethod($object, $method)
    {
        if (method_exists($object, $method)) {

            $this->explodeParameters();

            
            if ($method == 'index') {

                unset($this->parameter[1]);
                
                return isset($this->parameter[2]) ? $this->parameter : null;
            }

            unset($this->parameter[1],$this->parameter[2]);

            return isset($this->parameter[3]) ? $this->parameter : null;
        }
    }
}
