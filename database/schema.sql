CREATE DATABASE IF NOT EXISTS almoxarifado CHARACTER SET utf8mb4;
USE almoxarifado;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    perfil ENUM('operador', 'admin') NOT NULL
);

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    quantidade INT NOT NULL DEFAULT 0,
    data_cadastro DATETIME NOT NULL
);

CREATE TABLE movimentacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT NOT NULL,
    usuario_id INT NOT NULL,
    tipo ENUM('entrada', 'saida') NOT NULL,
    quantidade INT NOT NULL,
    data_hora DATETIME NOT NULL,
    FOREIGN KEY (produto_id) REFERENCES produtos(id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Administrador inicial: admin@almoxarifado.com / senha admin123
INSERT INTO usuarios (nome, email, senha, perfil) VALUES
('Administrador', 'admin@almoxarifado.com', '$2y$10$NE08Hf.FUTruisvIGp4p3ukGOmoAtEQ7dFrohnYr9idioc8j8lxzS', 'admin');
