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
    public function explodeParameters(): array
    {
        $explodeUri = explode('/', $this->uri);

        // Remove valores vazios e renumera os índices
        $this->parameter = array_values(array_filter($explodeUri));

        return $this->parameter;
    }
}
