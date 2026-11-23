<?php
// Configuração do banco MySQL. Pode ser sobrescrita por variáveis de ambiente.
return [
    'dsn'     => getenv('DB_DSN') ?: 'mysql:host=localhost;dbname=almoxarifado;charset=utf8mb4',
    'usuario' => getenv('DB_USER') ?: 'root',
    'senha'   => getenv('DB_PASS') !== false ? getenv('DB_PASS') : '',
];
