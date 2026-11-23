# Sistema de Almoxarifado

Sistema em PHP (arquitetura MVC) com banco MySQL para controle de estoque de materiais de limpeza.

## Como executar

1. Crie o banco executando `database/schema.sql` no MySQL.
2. Ajuste usuário e senha do banco em `app/config.php`.
3. Na raiz do projeto, execute: `php -S localhost:8080`
4. Acesse `http://localhost:8080` e entre com o administrador inicial:
   - E-mail: `admin@almoxarifado.com`
   - Senha: `admin123`

## Perfis

- **Operador:** consulta, insere e atualiza dados.
- **Administrador:** consulta, insere, atualiza e exclui dados; também cadastra usuários.

## Estrutura

- `index.php`: roteador e controle de acesso por perfil.
- `app/models`: acesso ao banco e regras de estoque (`Usuario`, `Produto`, `Movimentacao`).
- `app/controllers`: recebem as requisições e chamam models e views.
- `app/views`: páginas HTML.
- `database/schema.sql`: criação das tabelas.
- `docs/plano_testes.docx`, `docs/testes/`, `resultados.docx`: plano, evidências e resultados dos testes.
