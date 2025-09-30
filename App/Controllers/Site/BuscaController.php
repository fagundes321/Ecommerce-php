<?php 

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Repositories\Site\ProdutoRepository;

/**
 * Controller responsável pela página de busca de produtos.
 * 
 * Fluxo:
 * - Recebe o termo de busca pela query string (?b=...)
 * - Sanitiza o termo para evitar injeções
 * - Consulta o repositório de produtos
 * - Renderiza a view de resultados com Twig
 */
class BuscaController extends BaseController
{
    private $produto;

    /**
     * No construtor, inicializa o repositório de produtos.
     */
    public function __construct()
    {
        $this->produto = new ProdutoRepository;
    }

    /**
     * Método principal da busca.
     * - Captura o termo de busca da URL (?b=...)
     * - Consulta os produtos correspondentes
     * - Envia os dados para a view `site_busca.html`
     */
    public function index()
    {
        // Captura e sanitiza o termo de busca da query string
        $busca = filter_input(INPUT_GET, 'b', FILTER_SANITIZE_SPECIAL_CHARS);

        // Consulta os produtos no repositório
        $produtosEncontrados = $this->produto->buscarProduto($busca); 

        // Monta array de dados para a view
        $dados = [
            'busca'   => $busca,
            'produto' => $produtosEncontrados
        ]; 

        // Renderiza a view Twig passando os dados
        echo $this->twig->render('site_busca.html', $dados);
    }
}
