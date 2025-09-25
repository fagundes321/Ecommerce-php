<?php

namespace App\Classes;

use App\Classes\Uri;

class BreadCrumb
{
    private $uri;

    public function __construct()
    {
        $uri = new Uri();
        $this->uri = $uri->getUri();
    }

    public function createBreadCrumb(): string
    {
        // Breadcrumb para busca
        if (strpos($this->uri, '?') !== false) {
            $parts = explode('=', $this->uri);
            $searchTerm = isset($parts[1]) ? str_replace('+', ' ', $parts[1]) : '';
            return "<span style='color:#000'>Você está buscando:</span> 
                    <span style='font-style: italic;'>
                        <a href='/' style=' color:#000;'>Início</a> &gt; {$searchTerm}
                    </span>";
        }

        // Para a página inicial
        if ($this->uri === '/') {
            return "<span style='color:#000;'>Navegação:</span> <span style='font-style: italic;'>Início</span>";
        }

        // Para outras páginas internas
        $segment = ltrim($this->uri, '/');
        return "<span style='color:#000'>Navegação:</span> 
                <span style='font-style: italic;'>
                    <a href='/' style=' color:#000;'>Início</a> &gt; {$segment}
                </span>";
    }
}
