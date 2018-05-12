<?php

// Criar um "objeto"
$usuario = ["nome" => "Tiago Gouvêa", "idade" => 36];

require 'conexao.php';

try {
// Salvar ele no banco de dados
    $sql = "insert into usuario (nome,idade) values (:n,:iii)";
    $std = $db->prepare($sql);
    $std->bindParam(":n", $usuario['nome'], PDO::PARAM_STR);
    $std->bindParam(":iii", $usuario['idade'], PDO::PARAM_INT);
    $sucesso = $std->execute();
    if ($sucesso){
        echo "Registro incluído!";
    } else {
        echo "Erro ao incluir!";
        var_dump($std->errorInfo());
    }


} catch (Exception $e) {
    var_dump($e);
//    die("Erro de conexão com o servidor!");
}
