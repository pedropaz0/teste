<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Almoxarifado</title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
<h1>Almoxarifado</h1>
<?php if ($usuarioLogado): ?>
    <p>
        Usuário: <?= htmlspecialchars($usuarioLogado['nome']) ?> (<?= $usuarioLogado['perfil'] ?>)
        | <a href="index.php?rota=produtos">Produtos</a>
        | <a href="index.php?rota=movimentacao_form">Registrar movimentação</a>
        | <a href="index.php?rota=movimentacoes">Movimentações</a>
        <?php if ($usuarioLogado['perfil'] === 'admin'): ?>
            | <a href="index.php?rota=usuarios">Usuários</a>
        <?php endif; ?>
        | <a href="index.php?rota=logout">Sair</a>
    </p>
    <hr>
<?php endif; ?>
<?php if (!empty($_SESSION['mensagem'])): ?>
    <p class="ok"><?= htmlspecialchars($_SESSION['mensagem']) ?></p>
    <?php unset($_SESSION['mensagem']); ?>
<?php endif; ?>
<?php if (!empty($_SESSION['erro'])): ?>
    <p class="erro"><?= htmlspecialchars($_SESSION['erro']) ?></p>
    <?php unset($_SESSION['erro']); ?>
<?php endif; ?>
