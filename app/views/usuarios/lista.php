<?php require __DIR__ . '/../topo.php'; ?>
<h2>Usuários</h2>
<p><a href="index.php?rota=usuario_form">Novo usuário</a></p>
<table>
    <tr><th>ID</th><th>Nome</th><th>E-mail</th><th>Perfil</th><th>Ações</th></tr>
    <?php foreach ($usuarios as $u): ?>
    <tr>
        <td><?= $u['id'] ?></td>
        <td><?= htmlspecialchars($u['nome']) ?></td>
        <td><?= htmlspecialchars($u['email']) ?></td>
        <td><?= $u['perfil'] ?></td>
        <td>
            <form method="post" action="index.php?rota=usuario_excluir" style="display:inline">
                <input type="hidden" name="id" value="<?= $u['id'] ?>">
                <button type="submit" onclick="return confirm('Excluir usuário?')">Excluir</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php require __DIR__ . '/../rodape.php'; ?>
