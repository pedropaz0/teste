<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

require_once __DIR__ . '/app/controllers/AuthController.php';
require_once __DIR__ . '/app/controllers/ProdutoController.php';
require_once __DIR__ . '/app/controllers/MovimentacaoController.php';
require_once __DIR__ . '/app/controllers/UsuarioController.php';

// rota => [controller, método, perfis permitidos (null = pública)]
$todos = ['operador', 'admin'];
$rotas = [
    'login'              => ['AuthController', 'login', null],
    'logout'             => ['AuthController', 'logout', null],
    'produtos'           => ['ProdutoController', 'listar', $todos],
    'produto_form'       => ['ProdutoController', 'formulario', $todos],
    'produto_excluir'    => ['ProdutoController', 'excluir', ['admin']],
    'movimentacoes'      => ['MovimentacaoController', 'listar', $todos],
    'movimentacao_form'  => ['MovimentacaoController', 'formulario', $todos],
    'usuarios'           => ['UsuarioController', 'listar', ['admin']],
    'usuario_form'       => ['UsuarioController', 'formulario', ['admin']],
    'usuario_excluir'    => ['UsuarioController', 'excluir', ['admin']],
];

$rota = $_GET['rota'] ?? (isset($_SESSION['usuario']) ? 'produtos' : 'login');
if (!isset($rotas[$rota])) {
    http_response_code(404);
    exit('Página não encontrada.');
}

list($classe, $metodo, $perfis) = $rotas[$rota];

if ($perfis !== null) {
    if (!isset($_SESSION['usuario'])) {
        header('Location: index.php?rota=login');
        exit;
    }
    if (!in_array($_SESSION['usuario']['perfil'], $perfis)) {
        http_response_code(403);
        exit('Acesso negado: seu perfil não tem permissão para esta operação.');
    }
    // Exclusões só por POST.
    if (substr($rota, -8) === '_excluir' && $_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        exit('Método não permitido.');
    }
}

(new $classe())->$metodo();
