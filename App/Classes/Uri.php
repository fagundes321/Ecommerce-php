<?php

namespace App\Classes;

/**
 * A classe Uri é responsável por gerenciar e normalizar
 * a URI atual da aplicação.
 * 
 * - Remove query strings da URL
 * - Normaliza o caminho (garante formato consistente)
 * - Permite remover um path base (caso o sistema esteja rodando em subdiretório)
 */
class Uri
{
    private $uri;

    /**
     * No construtor:
     * - Pega a URI atual do navegador (sem query string)
     * - Remove o basePath se configurado
     */
    public function __construct()
    {
        // Remove query strings da URI (mantém apenas o path)
        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Remove o path base se estiver usando Docker/virtualhost
        $this->uri = $this->removeBasePath($this->uri);
    }

    /**
     * Verifica se a URI está vazia ou se é apenas a raiz (/).
     * 
     * @return bool
     */
    public function emptyUri()
    {
        return ($this->uri == '/' || empty(trim($this->uri, '/')));
    }

    /**
     * Retorna a URI já normalizada.
     * 
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Remove o "basePath" da URI caso o projeto esteja em subdiretório.
     * Exemplo: se o sistema estiver em "/meu-projeto", remove essa parte.
     * 
     * @param string $uri
     * @return string
     */
    private function removeBasePath($uri)
    {
        // Configure aqui caso o projeto esteja em um subdiretório
        $basePath = ''; // exemplo: '/meu-projeto'
        
        if (!empty($basePath) && strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }
        
        // Retorna "/" caso a URI fique vazia
        return $uri ?: '/';
    }
}
