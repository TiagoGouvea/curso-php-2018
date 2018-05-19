<?php
    //var_dump($_GET);
    require 'conexao.php';

    $id = $_GET['id'];

    try {
        // var_dump($id);
        $sql = "
                DELETE FROM fase WHERE id={$id}
            ";

        $std = $db->prepare($sql);
        // var_dump($sql);
        $success = $std->execute();
        // var_dump($success);
        if ($success) {
            $result = $std->fetchAll(PDO::FETCH_OBJ);
            try {
                $sql = "SELECT * FROM fase ORDER BY ordem";
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
        } else {
            echo "Erro na busca";
        }

    } catch (Exception $e) {
        echo "<p>Erro ao conectar com o servidor</p>";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Fases</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
              integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    </head>
    <body>
    <div class="container">
        <div class="header">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Trilhas</a>
                <a class="navbar-brand" href="add.php">Adicionar</a>
            </nav>
        </div>
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