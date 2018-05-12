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
                    <a class="navbar-brand" href="index.php">Fases</a>
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
            <div class="containt">
                <form method="post">
                    <div class="form-group">
                        <label for="title">Titulo</label>
                        <input type="text" class="form-control" id="title" placeholder="Insira o titulo" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <textarea type="text" class="form-control" id="description" placeholder="Insira a descrição da fase" rows="10" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="numFase">Example select</label>
                        <select class="form-control" id="numFase" name="numFase" required>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="status" name="status" value="1" checked required>
                        <label class="form-check-label" for="status">Ativo</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </body>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: leonardo
 * Date: 12/05/18
 * Time: 15:02
 */

    require 'conexao.php';


    var_dump($_POST);
    $sql = "
      INSERT INTO fase (
        titulo, 
        conteudo, 
        ordem, 
        ativa
      ) 
      VALUES (
        :title, 
        :description, 
        :numFase, 
        :status
      )
    ";

    $std = $db->prepare($sql);
    $std->bindParam(":title",$_POST['title'], PDO::PARAM_STR);
    $std->bindParam(":description", $_POST['description'], PDO::PARAM_STR);
    $std->bindParam(":numFase", $_POST['numFase'], PDO::PARAM_INT);
    $std->bindParam(":status", $_POST['status'], PDO::PARAM_BOOL);
    $success = $std->execute();
    if ($success)
        echo "Registro incluído";
    else
        echo "Falha ao incluir o registro";
?>