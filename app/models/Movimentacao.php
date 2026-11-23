<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Produto.php';

class Movimentacao
{
    // Registra entrada ou saída e atualiza o saldo. Retorna null se deu certo ou a mensagem de erro.
    public static function registrar($produtoId, $usuarioId, $tipo, $quantidade)
    {
        $pdo = Database::conectar();
        $produto = Produto::buscar($produtoId);
        if (!$produto) {
            return 'Produto não encontrado.';
        }

        $pdo->beginTransaction();

        if ($tipo === 'saida') {
            // O UPDATE só altera se o saldo for suficiente, evitando retirada acima do estoque.
            $stmt = $pdo->prepare('UPDATE produtos SET quantidade = quantidade - ? WHERE id = ? AND quantidade >= ?');
            $stmt->execute([$quantidade, $produtoId, $quantidade]);
            if ($stmt->rowCount() === 0) {
                $pdo->rollBack();
                $disponivel = Produto::buscar($produtoId)['quantidade'];
                return "Saída não permitida: estoque insuficiente. Disponível: $disponivel. Solicitado: $quantidade.";
            }
        } else {
            $stmt = $pdo->prepare('UPDATE produtos SET quantidade = quantidade + ? WHERE id = ?');
            $stmt->execute([$quantidade, $produtoId]);
        }

        $stmt = $pdo->prepare('INSERT INTO movimentacoes (produto_id, usuario_id, tipo, quantidade, data_hora) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$produtoId, $usuarioId, $tipo, $quantidade, date('Y-m-d H:i:s')]);
        $pdo->commit();
        return null;
    }

    public static function listar()
    {
        $sql = 'SELECT m.*, p.nome AS produto, u.nome AS usuario
                FROM movimentacoes m
                JOIN produtos p ON p.id = m.produto_id
                JOIN usuarios u ON u.id = m.usuario_id
                ORDER BY m.data_hora DESC, m.id DESC';
        return Database::conectar()->query($sql)->fetchAll();
    }
}
