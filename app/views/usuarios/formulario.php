<?php require __DIR__ . '/../topo.php'; ?>
<h2>Novo usuário</h2>
<?php if ($erro): ?><p class="erro"><?= htmlspecialchars($erro) ?></p><?php endif; ?>
<form method="post">
    <p>Nome: <input type="text" name="nome" required></p>
    <p>E-mail: <input type="email" name="email" required></p>
    <p>Senha: <input type="password" name="senha" required></p>
    <p>Perfil:
        <select name="perfil">
            <option value="operador">Operador de Almoxarifado</option>
            <option value="admin">Administrador do Sistema</option>
        </select>
    </p>
    <button type="submit">Cadastrar</button>
    <a href="index.php?rota=usuarios">Voltar</a>
</form>
<?php require __DIR__ . '/../rodape.php'; ?>
