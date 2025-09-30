<?php

namespace App\Controllers;

/**
 * BaseController
 * 
 * Classe base para todos os controllers da aplicação.
 * 
 * - Fornece propriedades e métodos comuns a todos os controllers.
 * - Facilita a injeção do ambiente Twig para renderização de templates.
 */
class BaseController 
{
    /**
     * @var \Twig\Environment Instância do Twig para renderizar templates
     */
    protected $twig;

    /**
     * Define a instância do Twig a ser usada pelo controller.
     * 
     * @param \Twig\Environment $twig
     */
    public function setTwig($twig)
    {
        $this->twig = $twig;
    }
}
