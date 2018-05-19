<?php
// Conectar no banco de dados

try {
    global $db;
    $db = new PDO(
        'mysql:dbname=desafio;host=167.99.233.184',
        'client',
        'TiagoGouvea'
    );
} catch (Exception $e) {
    die("Erro de conexão com o servidor!");
}


