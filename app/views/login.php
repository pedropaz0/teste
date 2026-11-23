<?php require __DIR__ . '/topo.php'; ?>
<h2>Login</h2>
<?php if ($erro): ?><p class="erro"><?= htmlspecialchars($erro) ?></p><?php endif; ?>
<form method="post">
    <p>E-mail: <input type="email" name="email" required></p>
    <p>Senha: <input type="password" name="senha" required></p>
    <button type="submit">Entrar</button>
</form>
<?php require __DIR__ . '/rodape.php'; ?>
