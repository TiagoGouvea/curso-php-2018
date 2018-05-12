<?php
/**
 * Created by PhpStorm.
 * User: leonardo
 * Date: 12/05/18
 * Time: 15:01
 */

 require 'conexao.php';

 try {
     $sql = 'SELECT * FROM fase';
     $std = $db->prepare($sql);
     $success = $std->execute();

     if ($success) {
         echo "Sucesso";
         $result = $std->fetchAll(PDO::FETCH_OBJ);
     } else {
         echo "Erro na busca";
     }


     echo "<pre>";
     var_dump($result);
     echo "</pre>";

 } catch (Exception $e) {
    var_dump($e);
 }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Fases</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="header">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="#">Fases</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="formFaseList.php">Lista <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="formFaseAdd.php">Adicionar <span class="sr-only">(current)</span></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="content">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ordem</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Conteúdo</th>
                        <th scope="col">Ativo</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        echo "
                            <tr>
                                <th scope='row'>1</th>
                                <td>{$result[0]->titulo}</td>
                            </tr>
                        ";
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>

