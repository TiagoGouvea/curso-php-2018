<?php

// Criar um "objeto"
$usuario = ["nome" => "Raquel Sousa", "idade" => 36];

require 'conexao.php';

try {
// Exibir registros
    $sql = "select * from usuario";
    $std = $db->prepare($sql);
    $sucesso = $std->execute();
    if ($sucesso) {
        echo "sucesso";
        $dados = $std->fetchAll(PDO::FETCH_OBJ);
//        var_dump($dados);

        ?>
        <table width="100%" border="1">
            <tr>
                <td>Id</td>
                <td>Nome</td>
                <td>Idade</td>
                <td>Ações</td>
            </tr>
            <?php
            foreach ($dados as $dado) {
                echo "<tr>
                        <td>$dado->id</td>
                        <td>$dado->nome</td>
                        <td>$dado->idade</td>
                        <td>
                            <a href='edit.php?id=$dado->id'>editar</a>
                            <a href='del.php?id=$dado->id'>excluir</a>
                        </td>
                    </tr>";
            }
            ?>
        </table>
        <?php
    } else {
        echo "Erro";
        var_dump($std->errorInfo());
    }


} catch (Exception $e) {
    var_dump($e);
//    die("Erro de conexão com o servidor!");
}


//try {
//// Salvar ele no banco de dados
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
//
//
//} catch (Exception $e) {
//    var_dump($e);
////    die("Erro de conexão com o servidor!");
//}
