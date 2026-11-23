<?php
class Controller
{
    protected function view($arquivoView, $dados = [])
    {
        extract($dados);
        $usuarioLogado = $_SESSION['usuario'] ?? null;
        require __DIR__ . '/../views/' . $arquivoView . '.php';
    }

    protected function redirecionar($rota, $mensagem = null, $erro = null)
    {
        if ($mensagem) {
            $_SESSION['mensagem'] = $mensagem;
        }
        if ($erro) {
            $_SESSION['erro'] = $erro;
        }
        header('Location: index.php?rota=' . $rota);
        exit;
    }

    protected function ehAdmin()
    {
        return ($_SESSION['usuario']['perfil'] ?? '') === 'admin';
    }
}
