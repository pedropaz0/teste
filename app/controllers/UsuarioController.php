<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController extends Controller
{
    public function listar()
    {
        $this->view('usuarios/lista', ['usuarios' => Usuario::listar()]);
    }

    public function formulario()
    {
        $erro = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $senha = $_POST['senha'] ?? '';
            $perfil = $_POST['perfil'] ?? '';

            if ($nome === '' || $email === '' || $senha === '' || !in_array($perfil, ['operador', 'admin'])) {
                $erro = 'Preencha todos os campos.';
            } elseif (Usuario::buscarPorEmail($email)) {
                $erro = 'Já existe um usuário com este e-mail.';
            } else {
                Usuario::criar($nome, $email, $senha, $perfil);
                $this->redirecionar('usuarios', 'Usuário cadastrado.');
            }
        }
        $this->view('usuarios/formulario', ['erro' => $erro]);
    }

    public function excluir()
    {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id === (int) $_SESSION['usuario']['id']) {
            $this->redirecionar('usuarios', null, 'Você não pode excluir o próprio usuário.');
        }
        try {
            Usuario::excluir($id);
            $this->redirecionar('usuarios', 'Usuário excluído.');
        } catch (PDOException $e) {
            $this->redirecionar('usuarios', null, 'Não é possível excluir: o usuário possui movimentações registradas.');
        }
    }
}
