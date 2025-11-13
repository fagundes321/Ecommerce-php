<?php 

namespace App\Classes;

class Frete
{
    private function calculouFrete()
    {
        // só considera que tem frete se as duas chaves existirem
        return isset($_SESSION['frete'], $_SESSION['valor_frete'])
            && $_SESSION['frete'] === true;
    }

    // grava o valor do frete na sessão
    public function gravarFrete($valorFrete)
    {
        // garante que é numérico
        $valor = (float) str_replace(',', '.', $valorFrete);

        $_SESSION['frete'] = true;
        $_SESSION['valor_frete'] = $valor;
    }

    // pega o valor do frete gravado
    public function pegarFrete()
    {
        if ($this->calculouFrete()) {
            return $_SESSION['valor_frete'];
        }

        // se não tiver frete gravado, retorna 0
        return 0;
    }

    public function limparFrete()
    {
        unset($_SESSION['frete'], $_SESSION['valor_frete']);
    }
}
