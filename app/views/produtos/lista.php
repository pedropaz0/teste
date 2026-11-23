<?php require __DIR__ . '/../topo.php'; ?>
<h2>Produtos</h2>
<form method="get">
    <input type="hidden" name="rota" value="produtos">
    Nome: <input type="text" name="nome" value="<?= htmlspecialchars($nome) ?>">
    Data de cadastro: <input type="date" name="data" value="<?= htmlspecialchars($data) ?>">
    <button type="submit">Filtrar</button>
    <a href="index.php?rota=produtos">Limpar</a>
</form>
<p><a href="index.php?rota=produto_form">Novo produto</a></p>
<table>
    <tr><th>ID</th><th>Nome</th><th>Saldo</th><th>Cadastro</th><th>Ações</th></tr>
    <?php foreach ($produtos as $p): ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= htmlspecialchars($p['nome']) ?></td>
        <td><?= $p['quantidade'] ?></td>
        <td><?= date('d/m/Y H:i', strtotime($p['data_cadastro'])) ?></td>
        <td>
            <a href="index.php?rota=produto_form&id=<?= $p['id'] ?>">Editar</a>
            <?php if ($usuarioLogado['perfil'] === 'admin'): ?>
            <form method="post" action="index.php?rota=produto_excluir" style="display:inline">
                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                <button type="submit" onclick="return confirm('Excluir produto?')">Excluir</button>
            </form>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php if (!$produtos): ?><tr><td colspan="5">Nenhum produto encontrado.</td></tr><?php endif; ?>
</table>
<p>
    <?php for ($i = 1; $i <= $paginas; $i++): ?>
        <?php if ($i == $pagina): ?>
            <strong>[<?= $i ?>]</strong>
        <?php else: ?>
            <a href="index.php?rota=produtos&nome=<?= urlencode($nome) ?>&data=<?= urlencode($data) ?>&pagina=<?= $i ?>"><?= $i ?></a>
        <?php endif; ?>
    <?php endfor; ?>
</p>
<?php require __DIR__ . '/../rodape.php'; ?>
