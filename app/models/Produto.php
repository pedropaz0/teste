<?php
require_once __DIR__ . '/Database.php';

class Produto
{
    const POR_PAGINA = 5;

    // Monta o WHERE conforme os filtros de nome e data de cadastro.
    private static function filtro($nome, $data)
    {
        $where = ' WHERE 1=1';
        $params = [];
        if ($nome !== '') {
            $where .= ' AND nome LIKE ?';
            $params[] = '%' . $nome . '%';
        }
        if ($data !== '') {
            $where .= ' AND DATE(data_cadastro) = ?';
            $params[] = $data;
        }
        return [$where, $params];
    }

    public static function contar($nome, $data)
    {
        list($where, $params) = self::filtro($nome, $data);
        $stmt = Database::conectar()->prepare('SELECT COUNT(*) FROM produtos' . $where);
        $stmt->execute($params);
        return (int) $stmt->fetchColumn();
    }

    public static function listar($nome, $data, $pagina)
    {
        list($where, $params) = self::filtro($nome, $data);
        $offset = ($pagina - 1) * self::POR_PAGINA;
        $sql = 'SELECT * FROM produtos' . $where . ' ORDER BY nome LIMIT ' . self::POR_PAGINA . ' OFFSET ' . (int) $offset;
        $stmt = Database::conectar()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public static function listarTodos()
    {
        return Database::conectar()->query('SELECT * FROM produtos ORDER BY nome')->fetchAll();
    }

    public static function buscar($id)
    {
        $stmt = Database::conectar()->prepare('SELECT * FROM produtos WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function criar($nome)
    {
        $stmt = Database::conectar()->prepare('INSERT INTO produtos (nome, quantidade, data_cadastro) VALUES (?, 0, ?)');
        $stmt->execute([$nome, date('Y-m-d H:i:s')]);
    }

    public static function atualizar($id, $nome)
    {
        $stmt = Database::conectar()->prepare('UPDATE produtos SET nome = ? WHERE id = ?');
        $stmt->execute([$nome, $id]);
    }

    public static function possuiMovimentacoes($id)
    {
        $stmt = Database::conectar()->prepare('SELECT COUNT(*) FROM movimentacoes WHERE produto_id = ?');
        $stmt->execute([$id]);
        return $stmt->fetchColumn() > 0;
    }

    public static function excluir($id)
    {
        $stmt = Database::conectar()->prepare('DELETE FROM produtos WHERE id = ?');
        $stmt->execute([$id]);
    }
}
