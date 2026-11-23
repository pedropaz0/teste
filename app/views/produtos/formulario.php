<?php require __DIR__ . '/../topo.php'; ?>
<h2><?= $produto ? 'Editar produto' : 'Novo produto' ?></h2>
<?php if ($erro): ?><p class="erro"><?= htmlspecialchars($erro) ?></p><?php endif; ?>
<form method="post">
    <input type="hidden" name="id" value="<?= $produto['id'] ?? '' ?>">
    <p>Nome: <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome'] ?? '') ?>" required></p>
    <button type="submit">Salvar</button>
    <a href="index.php?rota=produtos">Voltar</a>
</form>
<?php require __DIR__ . '/../rodape.php'; ?>
