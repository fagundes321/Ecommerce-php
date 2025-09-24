<?php

namespace App\Controllers;

use App\Classes\Uri;

class Method
{
    private $uri;

    public function __construct()
    {
        $this->uri = new Uri;
    }

    private function getMethod()
    {
        if (!$this->uri->emptyUri()) {
            $explodeUri = array_filter(explode('/', $this->uri->getUri()));
            return $explodeUri[2] ?? null;
            // return (isset($explodeUri[2])) ? $explodeUri[2] : DEFAULT_METHOD ;
        }

        return null;
    }
    
    public function method($object): string
    {
        $method = $this->getMethod();

        if ($method && method_exists($object, $method)) {
            return $method;
        }

        return DEFAULT_METHOD;
    }
}
