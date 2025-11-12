<?php

namespace App\Classes;

use GuzzleHttp\Client;

class Correios
{
    private $token;
    private $cepDestino;
    private $cepOrigem;
    private $peso;
    private $comprimento;
    private $altura;
    private $largura;
    private $melhorEnvios;

    public function __construct()
    {
        $this->melhorEnvios = new Client();
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function setCepOrigem($cepOrigem)
    {
        $this->cepOrigem = $cepOrigem;
    }

    public function setCepDestino($cepDestino)
    {
        $this->cepDestino = $cepDestino;
    }

    public function setPeso($peso)
    {
        $this->peso = $peso;
    }

    public function setComprimento($comprimento)
    {
        $this->comprimento = $comprimento;
    }

    public function setAltura($altura)
    {
        $this->altura = $altura;
    }

    public function setLargura($largura)
    {
        $this->largura = $largura;
    }

    private function dadosCalcularFrete()
    {
        $body = [
            'from' => ['postal_code' => $this->cepOrigem],
            'to'   => ['postal_code' => $this->cepDestino],
            'products' => [[
                'width'  => (float) $this->largura,
                'height' => (float) $this->altura,
                'length' => (float) $this->comprimento,
                'weight' => (float) $this->peso,
                'quantity' => 1,
                'insurance_value' => 0
            ]]
        ];

        $response = $this->melhorEnvios->request('POST', 'https://www.melhorenvio.com.br/api/v2/me/shipment/calculate', [
            'headers' => [
                'Accept'        => 'application/json',
                'Authorization' => 'Bearer ' . $this->token,
                'Content-Type'  => 'application/json',
                'User-Agent'    => 'MinhaAplicacao (email@exemplo.com)',
            ],
            'json' => $body,
            'http_errors' => false, // evita exception em erro HTTP
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function calcularFrete()
    {
        return $this->dadosCalcularFrete();
    }
}
