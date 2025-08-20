<?php

namespace App\Classes;

class Template
{
    public function loader()
    {
        return new \Twig\Loader\FilesystemLoader([
            __DIR__ . '/../Views/Site',
            __DIR__ . '/../Views/Admin'
        ]);
    }

    public function init()
    {
        return new \Twig\Environment($this->loader(), [
            'debug' => true,
            'auto_reload' => true,
            // 'cache' => __DIR__ . '/../../cache/twig' // descomente se quiser cache
        ]);

        return $twig;
    }
}
