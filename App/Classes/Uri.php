<?php

namespace App\Classes;

class Uri
{
    private $uri;

    public function __construct()
    {
        // Remove query strings e normaliza a URI
        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Remove o path base se estiver usando Docker/virtualhost
        $this->uri = $this->removeBasePath($this->uri);
    }

    public function emptyUri()
    {
        return ($this->uri == '/' || empty(trim($this->uri, '/')));
    }

    public function getUri()
    {
        return $this->uri;
    }

    private function removeBasePath($uri)
    {
        // Se estiver rodando em subdiretório no Docker, ajuste aqui
        $basePath = ''; // ou '/seu-projeto' se aplicável
        
        if (!empty($basePath) && strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }
        
        return $uri ?: '/';
    }
}