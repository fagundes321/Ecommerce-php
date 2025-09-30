<?php

namespace App\Classes;

/**
 * Essa classe é responsável por inicializar e configurar
 * o sistema de templates Twig dentro da aplicação.
 */
class Template
{
    /**
     * Carrega os diretórios onde ficam os arquivos de views (Site e Admin).
     * 
     * @return \Twig\Loader\FilesystemLoader
     */
    public function loader()
    {
        return new \Twig\Loader\FilesystemLoader([
            __DIR__ . '/../Views/Site',   // diretório para templates do site
            __DIR__ . '/../Views/Admin'   // diretório para templates do admin
        ]);
    }

    /**
     * Inicializa o ambiente Twig com as configurações desejadas.
     * 
     * @return \Twig\Environment
     */
    public function init()
    {
        return new \Twig\Environment($this->loader(), [
            'debug' => true,       // habilita debug no Twig
            'auto_reload' => true, // recompila templates modificados automaticamente
            // 'cache' => __DIR__ . '/../../cache/twig' // habilite se quiser cache de templates
        ]);
    }
}
