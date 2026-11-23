<?php require __DIR__ . '/../topo.php'; ?>
<h2>Movimentações</h2>
<table>
    <tr><th>Data/hora</th><th>Produto</th><th>Tipo</th><th>Quantidade</th><th>Responsável</th></tr>
    <?php foreach ($movimentacoes as $m): ?>
    <tr>
        <td><?= date('d/m/Y H:i:s', strtotime($m['data_hora'])) ?></td>
        <td><?= htmlspecialchars($m['produto']) ?></td>
        <td><?= $m['tipo'] === 'saida' ? 'Saída' : 'Entrada' ?></td>
        <td><?= $m['quantidade'] ?></td>
        <td><?= htmlspecialchars($m['usuario']) ?></td>
    </tr>
    <?php endforeach; ?>
    <?php if (!$movimentacoes): ?><tr><td colspan="5">Nenhuma movimentação registrada.</td></tr><?php endif; ?>
</table>
<?php require __DIR__ . '/../rodape.php'; ?>
