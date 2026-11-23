<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/Produto.php';

class ProdutoController extends Controller
{
    public function listar()
    {
        $nome = trim($_GET['nome'] ?? '');
        $data = $_GET['data'] ?? '';
        $total = Produto::contar($nome, $data);
        $paginas = max(1, (int) ceil($total / Produto::POR_PAGINA));
        $pagina = min($paginas, max(1, (int) ($_GET['pagina'] ?? 1)));

        $this->view('produtos/lista', [
            'produtos' => Produto::listar($nome, $data, $pagina),
            'nome' => $nome,
            'data' => $data,
            'pagina' => $pagina,
            'paginas' => $paginas,
        ]);
    }

    public function formulario()
    {
        $produto = null;
        if (!empty($_GET['id'])) {
            $produto = Produto::buscar((int) $_GET['id']);
        }
        $erro = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');
            $id = (int) ($_POST['id'] ?? 0);
            if ($nome === '') {
                $erro = 'Informe o nome do produto.';
                $produto = ['id' => $id, 'nome' => $nome];
            } elseif ($id) {
                Produto::atualizar($id, $nome);
                $this->redirecionar('produtos', 'Produto atualizado.');
            } else {
                Produto::criar($nome);
                $this->redirecionar('produtos', 'Produto cadastrado.');
            }
        }
        $this->view('produtos/formulario', ['produto' => $produto, 'erro' => $erro]);
    }

    public function excluir()
    {
        $id = (int) ($_POST['id'] ?? 0);
        if (Produto::possuiMovimentacoes($id)) {
            $this->redirecionar('produtos', null, 'Não é possível excluir: o produto possui movimentações registradas.');
        }
        Produto::excluir($id);
        $this->redirecionar('produtos', 'Produto excluído.');
    }
}
