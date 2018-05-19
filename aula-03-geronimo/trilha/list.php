<?php

require 'conexao.php';

    try {
        $sql = "SELECT * FROM trilha ORDER BY ordem";
        $std = $db->prepare($sql);
        $success = $std->execute();

        if ($success) {
            $result = $std->fetchAll(PDO::FETCH_OBJ);
        } else {
            echo "Erro na busca";
        }
    } catch (Exception $e) {
        var_dump($e);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Trilhas</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
              integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="content">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ordem</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Ativo</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($result as $item) {
                            echo "
                                <tr>
                                    <th scope='row'>{$item->id}</th>
                                    <td>{$item->ordem}</td>
                                    <td>{$item->titulo}</td>
                                    <td>{$item->ativa}</td>
                                    <td><a class='btn btn-outline-secondary' role='button' href='add.php?id=$item->id'>Alterar</a></td>
                                    <td><a class='btn btn-outline-secondary' role='button' href='delete.php?id=$item->id'>Excluir</a></td>
                                </tr>
                            ";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>

