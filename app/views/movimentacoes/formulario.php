<?php require __DIR__ . '/../topo.php'; ?>
<h2>Registrar movimentação</h2>
<?php if ($erro): ?><p class="erro"><?= htmlspecialchars($erro) ?></p><?php endif; ?>
<?php if ($mensagem): ?><p class="ok"><?= htmlspecialchars($mensagem) ?></p><?php endif; ?>
<form method="post">
    <p>Produto:
        <select name="produto_id" required>
            <?php foreach ($produtos as $p): ?>
                <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nome']) ?> (saldo: <?= $p['quantidade'] ?>)</option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>Tipo:
        <select name="tipo">
            <option value="entrada">Entrada</option>
            <option value="saida">Saída</option>
        </select>
    </p>
    <p>Quantidade: <input type="number" name="quantidade" min="1" required></p>
    <button type="submit">Registrar</button>
</form>
<?php require __DIR__ . '/../rodape.php'; ?>
