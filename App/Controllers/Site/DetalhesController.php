<?php 

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Models\Site\ProdutoModel;

/**
 * Controller responsável pela página de detalhes de um produto.
 * 
 * Fluxo:
 * - Recebe o slug do produto pela URL
 * - Busca o produto no banco através do Model
 * - Caso não encontre, retorna mensagem simples
 * - Caso encontre, envia os dados para a view Twig
 */
class DetalhesController extends BaseController
{
    private $produto;

    /**
     * Construtor: inicializa o model de produtos.
     */
    public function __construct()
    {
        $this->produto = new ProdutoModel;
    }

    /**
     * Exibe os detalhes de um produto.
     * 
     * @param string $slug Slug do produto vindo da rota
     */
    public function index($slug)
    {

        //    $carrinho = new \App\Classes\Carrinho();
        // dump($carrinho->add(1));

        // Busca o produto pelo slug
        $produtoEncontrado = $this->produto->find('produto_slug', $slug);

        // Caso o produto não seja encontrado
        if (!$produtoEncontrado) {
            echo "Produto não encontrado.";
            return;
        }

        // Monta os dados a serem enviados para a view
        $dados = [
            'produto' => $produtoEncontrado,
            'titulo'  => 'InovaTech | Loja Virtual',
        ];

        // Renderiza o template Twig de detalhes
        echo $this->twig->render('site_detalhes.html', $dados);
    }
}
