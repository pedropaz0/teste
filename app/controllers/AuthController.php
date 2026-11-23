<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/Usuario.php';

class AuthController extends Controller
{
    public function login()
    {
        $erro = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = Usuario::buscarPorEmail(trim($_POST['email'] ?? ''));
            if ($usuario && password_verify($_POST['senha'] ?? '', $usuario['senha'])) {
                $_SESSION['usuario'] = [
                    'id' => $usuario['id'],
                    'nome' => $usuario['nome'],
                    'perfil' => $usuario['perfil'],
                ];
                $this->redirecionar('produtos');
            }
            $erro = 'E-mail ou senha inválidos.';
        }
        $this->view('login', ['erro' => $erro]);
    }

    public function logout()
    {
        session_destroy();
        header('Location: index.php?rota=login');
        exit;
    }
}
