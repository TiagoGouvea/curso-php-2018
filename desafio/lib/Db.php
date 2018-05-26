<?php
/**
 * Não é a forma ideal ainda!
 *
 * Arquivo responsável por "compartilhar" a conexão do banco.
 * O correto seria o slim fornecer acesso à conexão com o banco
 * ao invés de acessarmos via global.
 */

// Conectar no banco de dados
try {

    global $db;
    $dsn = 'mysql:dbname=' . $_ENV["db_name"] . ';host=' . $_ENV["db_host"];
    $db = new PDO(
        $dsn,
        $_ENV["db_user"],
        $_ENV["db_password"], array(
            PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
        )
    );
    $numRows = $db->exec("SELECT CURRENT_TIMESTAMP");
} catch (PDOException $e) {
    $e->getMessage();
    echo "<html>Erro de conexão com o servidor!<br>Mensagem: " . $e->getMessage();
    die();
}
?>