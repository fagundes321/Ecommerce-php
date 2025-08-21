<?php 

namespace App\Classes;

class Parameters{

    private $uri;
    private $parameter;

    public function __construct()
    {
        $uri = new Uri;
        $this->uri = $uri->getUri();
    }

    public function explodeParameters(){
        $explodeUri = explode('/', $this->uri);
        $this->parameter = array_filter($explodeUri);
        return $this->parameter;
    }
}