<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>List</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    </head>
    <body>
        <div>
            <div class="header">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="#">Fases</a>
                    <a class="navbar-brand" href="incluir">Adicionar</a>
                </nav>
            </div>
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
                        if (isset($result)) {
                            foreach ($result as $item) {
                                echo "
                                <tr>
                                    <th scope='row'>{$item->id}</th>
                                    <td>{$item->ordem}</td>
                                    <td>{$item->titulo}</td>
                                    <td>{$item->ativa}</td>
                                    <td><a class='btn btn-outline-secondary' role='button' href='editar/$item->id'>Alterar</a></td>
                                    <td><a class='btn btn-outline-secondary' role='button' href='excluir/$item->id'>Excluir</a></td>
                                </tr>
                            ";
                            }
                        } else {
                            $result = 'Sem registro';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>