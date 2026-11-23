<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/Produto.php';
require_once __DIR__ . '/../models/Movimentacao.php';

class MovimentacaoController extends Controller
{
    public function listar()
    {
        $this->view('movimentacoes/lista', ['movimentacoes' => Movimentacao::listar()]);
    }

    public function formulario()
    {
        $erro = null;
        $mensagem = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $produtoId = (int) ($_POST['produto_id'] ?? 0);
            $tipo = $_POST['tipo'] ?? '';
            $quantidade = (int) ($_POST['quantidade'] ?? 0);

            if (!in_array($tipo, ['entrada', 'saida']) || $quantidade <= 0) {
                $erro = 'Informe o tipo e uma quantidade maior que zero.';
            } else {
                $erro = Movimentacao::registrar($produtoId, $_SESSION['usuario']['id'], $tipo, $quantidade);
                if ($erro === null) {
                    $mensagem = ucfirst($tipo === 'saida' ? 'saída' : 'entrada') . ' registrada com sucesso.';
                }
            }
        }
        $this->view('movimentacoes/formulario', [
            'produtos' => Produto::listarTodos(),
            'erro' => $erro,
            'mensagem' => $mensagem,
        ]);
    }
}
