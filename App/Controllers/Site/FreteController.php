<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Repositories\Site\ProdutosCarrinhoRepository;
use App\Classes\Correios;
use App\Classes\Frete;
use App\Classes\Logado;

class FreteController extends BaseController
{
    private $produtoCarrinhoRepository;
    private $correios;

    public function __construct()
    {
        $this->produtoCarrinhoRepository = new ProdutosCarrinhoRepository();
        $this->correios = new Correios();
    }

    public function calcular()
    {
        $produtosCarrinho = $this->produtoCarrinhoRepository->produtosNoCarrinho();

        $logado = new Logado();

        if(!$logado->logado()){
            echo json_encode('login');
            die();
        }

        if (empty($produtosCarrinho)) {
            echo json_encode(['erro' => 'produto']);
            return;
        }

        $cep = trim(preg_replace('/[^0-9\-]/', '', $_POST['frete'] ?? ''));

        if (!$cep) {
            echo json_encode(['erro' => 'cep_invalido']);
            return;
        }

        $this->correios->setToken('eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOWE3NjkwMzVhYjI0YTA5MWVkYTE0MmYzMmE4OTMxYTIzY2Q0ODM3NjBmNTNjN2Q5ZjJkYWMyNzljZTBjYTRhN2IyMGRlYzRhNDFmMGExMWUiLCJpYXQiOjE3NjI4NzUwNDEuNDMwOTc3LCJuYmYiOjE3NjI4NzUwNDEuNDMwOTgsImV4cCI6MTc5NDQxMTA0MS40MTc3OTYsInN1YiI6ImEwNTM3YjEzLWYyZjktNGEwNS1iYWJjLThlOTIyOTc3ZmFiNCIsInNjb3BlcyI6WyJzaGlwcGluZy1jYWxjdWxhdGUiXX0.J6uSRwyfVTOhHm6VHds80rvOz9UU9vtNSLOnE1cZ8-VCImSUE_MsxNGX2dE1oINB6JwyO-ibRw91yEALOAwAB73IZZyjE35Y8zDs4BEpixr5f-oT8GDoXBcntiA-ioc4Vxwq1qHIyROaXTa2nQKwB49cUQtRaChDfi4WPK_XAB0rTA6N-l5zhb0ZintA2Ok8eEQBFRbWsh0nYRfM8NhDwcK4GbMELgQBVfBEPHbNpqAcbTftx_19dtqck1yGWCeauGYUKtmUgWx-x3WaPu6rUTI49QrgFJrtIfqVYtUDfRjSA9J_cSAnw-YEiaggHHNxpdC1HBCkUXKq-27CKSIOhE2IlYvR1o2tTX3ax3RM7SUj5ql79b7ZeCI83BV_o3TdZ291MJeZNYESPhOQdwhRjaLxtddZ9Ba0J2wtxR-zoBXykWG4Jh5bKqiw10viy9RPYBGhj1PB0XNWmWzdfg_TXHX7cQlrl0bCP3F8oh61ph0G1kVWpfDmeWpwcWrkClE7xVYPwDR57fJPt3AKCPDL0xfqtNC8PVwGwaFtjIItuh3LM38ere1IqtPBcANSeSWVZPTv7qleTAmwp_InUolt9a7Y663_1iaI0yXAOJ0HwMGHlNK4RJkuHH7Y6akBR8pugQKTg9ldj_3mYeBthBiWbKC0LkCYuw3uAuxKDirNbIg');
        $this->correios->setCepOrigem('59040360');
        $this->correios->setCepDestino(str_replace('-', '', $cep));
        $this->correios->setPeso('1');
        $this->correios->setComprimento('20');
        $this->correios->setAltura('10');
        $this->correios->setLargura('15');

        $dadosFrete = $this->correios->calcularFrete();

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($dadosFrete, JSON_PRETTY_PRINT);
    }

    // 🔹 novo método: grava o frete escolhido na sessão
    public function selecionar()
    {
        $preco = $_POST['preco'] ?? null;

        if ($preco === null) {
            echo json_encode(['erro' => 'preco_invalido']);
            return;
        }

        $frete = new Frete();
        $frete->gravarFrete($preco);

        echo json_encode(['sucesso' => true]);
    }
}
