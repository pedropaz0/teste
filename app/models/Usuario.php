<?php
require_once __DIR__ . '/Database.php';

class Usuario
{
    public static function buscarPorEmail($email)
    {
        $stmt = Database::conectar()->prepare('SELECT * FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public static function listar()
    {
        return Database::conectar()->query('SELECT id, nome, email, perfil FROM usuarios ORDER BY nome')->fetchAll();
    }

    public static function criar($nome, $email, $senha, $perfil)
    {
        $stmt = Database::conectar()->prepare('INSERT INTO usuarios (nome, email, senha, perfil) VALUES (?, ?, ?, ?)');
        $stmt->execute([$nome, $email, password_hash($senha, PASSWORD_DEFAULT), $perfil]);
    }

    public static function excluir($id)
    {
        $stmt = Database::conectar()->prepare('DELETE FROM usuarios WHERE id = ?');
        $stmt->execute([$id]);
    }
}
