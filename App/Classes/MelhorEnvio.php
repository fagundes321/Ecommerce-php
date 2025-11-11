<?php

namespace App\Classes;

use Cagartner\CorreiosConsulta\CorreiosConsulta;
use GuzzleHttp\Client;

class Correios
{

    private $token;
    private $tipo;
    private $formato;
    private $cepDestino;
    private $cepOrigem;
    private $peso;
    private $comprimento;
    private $altura;
    private $largura;
    private $diametro;
    private $correios;
    private $melhorEnvios;

    public function __construct()
    {
        $this->correios = new CorreiosConsulta();
        $this->melhorEnvios = new Client();
    }

    // public function setTipo($tipo)
    // {
    //     $this->tipo = $tipo;
    // }

    // public function setFormato($formato)
    // {
    //     $this->formato = $formato;
    // }

    // public function setCepDestino($cepDestino)
    // {
    //     $this->cepDestino = $cepDestino;
    // }

    public function setToken($token){
        $this->token = $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOWE3NjkwMzVhYjI0YTA5MWVkYTE0MmYzMmE4OTMxYTIzY2Q0ODM3NjBmNTNjN2Q5ZjJkYWMyNzljZTBjYTRhN2IyMGRlYzRhNDFmMGExMWUiLCJpYXQiOjE3NjI4NzUwNDEuNDMwOTc3LCJuYmYiOjE3NjI4NzUwNDEuNDMwOTgsImV4cCI6MTc5NDQxMTA0MS40MTc3OTYsInN1YiI6ImEwNTM3YjEzLWYyZjktNGEwNS1iYWJjLThlOTIyOTc3ZmFiNCIsInNjb3BlcyI6WyJzaGlwcGluZy1jYWxjdWxhdGUiXX0.J6uSRwyfVTOhHm6VHds80rvOz9UU9vtNSLOnE1cZ8-VCImSUE_MsxNGX2dE1oINB6JwyO-ibRw91yEALOAwAB73IZZyjE35Y8zDs4BEpixr5f-oT8GDoXBcntiA-ioc4Vxwq1qHIyROaXTa2nQKwB49cUQtRaChDfi4WPK_XAB0rTA6N-l5zhb0ZintA2Ok8eEQBFRbWsh0nYRfM8NhDwcK4GbMELgQBVfBEPHbNpqAcbTftx_19dtqck1yGWCeauGYUKtmUgWx-x3WaPu6rUTI49QrgFJrtIfqVYtUDfRjSA9J_cSAnw-YEiaggHHNxpdC1HBCkUXKq-27CKSIOhE2IlYvR1o2tTX3ax3RM7SUj5ql79b7ZeCI83BV_o3TdZ291MJeZNYESPhOQdwhRjaLxtddZ9Ba0J2wtxR-zoBXykWG4Jh5bKqiw10viy9RPYBGhj1PB0XNWmWzdfg_TXHX7cQlrl0bCP3F8oh61ph0G1kVWpfDmeWpwcWrkClE7xVYPwDR57fJPt3AKCPDL0xfqtNC8PVwGwaFtjIItuh3LM38ere1IqtPBcANSeSWVZPTv7qleTAmwp_InUolt9a7Y663_1iaI0yXAOJ0HwMGHlNK4RJkuHH7Y6akBR8pugQKTg9ldj_3mYeBthBiWbKC0LkCYuw3uAuxKDirNbIg";
    }

    public function setCepOrigem($cepOrigem)
    {
        $this->cepOrigem = $cepOrigem;
    }

    // public function setPeso($peso)
    // {
    //     $this->peso = $peso;
    // }

    // public function setComprimento($comprimento)
    // {
    //     $this->comprimento = $comprimento;
    // }

    // public function setAltura($altura)
    // {
    //     $this->altura = $altura;
    // }

    // public function setLargura($largura)
    // {
    //     $this->largura = $largura;
    // }

    // public function setDiametro($diametro)
    // {
    //     $this->diametro = $diametro;
    // }

    // public function setCorreios($correios)
    // {
    //     $this->correios = $correios;
    // }

    private function dadosCalcularFrete()
    {




        $dados = $this->melhorEnvios->request('POST', 'https://www.melhorenvio.com.br/api/v2/me/shipment/calculate', [
            'body' => '{"from":{"postal_code":"'. $this->cepOrigem .'"},"to":{"postal_code":"'. $this->cepDestino .'"},"products":[{"width":'. $this->largura .',"height":'. $this->altura .',"length":'. $this->comprimento .',"weight":'. $this->comprimento .']}',
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. $this->token .'',
                'Content-Type' => 'application/json',
                'User-Agent' => 'Aplicação (email para contato técnico)',
            ],
        ]);

        // echo $response->getBody();
        return $dados;
    }

    public function calcularFrete()
    {
        return $this->melhorEnvios->$this->dadosCalcularFrete();
    }
}
