<?php

namespace App\Classes;

/**
 * Essa classe é responsável por realizar redirecionamentos na aplicação.
 * O que ela retorna?
 * - Ela envia um cabeçalho HTTP de redirecionamento (Location)
 * - Encerra a execução do script após o redirecionamento com `exit`
 */
class Redirect
{
    /**
     * Faz o redirecionamento.
     * 
     * @param string|null $redirect
     * Caso o parâmetro não seja informado, o usuário é redirecionado para a raiz "/".
     * Caso seja informado, o usuário é redirecionado para o caminho fornecido.
     */
    public function redirect($redirect = null)
    {
        // Se não foi passado nenhum caminho, redireciona para a página inicial
        if (is_null($redirect)) {
            header('Location: /');
            exit; // boa prática: encerrar o script após o redirecionamento
        }

        // Caso contrário, redireciona para o caminho informado
        header("Location: $redirect");
        exit;
    }
}
