<?php

require 'conexao.php';

if (count($_POST) > 0) {

    $erro = null;

    try {
        $sql = 'SELECT p.id, p.id_fase, p.titulo, p.tipo, p.ativa
                FROM
                  opcao AS p
                LEFT JOIN
                  opcao AS o ON o.id = p.id_fase';
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

    if (empty($_POST['titulo'] )) {
        $erro = "Título vazio";
    } else if (empty($_POST['tipo'] )) {
        $erro = "Tipo vazio";
    } else {
        try {
            // Salvar ele no banco de dados

            $sql = "insert into pergunta (titulo, tipo, ativa) values (:var1, :var2, :var3)";
            $std = $db->prepare($sql);
            $std->bindParam(":var1", $_POST['titulo'], PDO::PARAM_STR);
            $std->bindParam(":var2", $_POST['tipo'], PDO::PARAM_STR);
            $std->bindParam(":var3", $_POST['ativo'], PDO::PARAM_BOOL);
            $sucesso = $std->execute();
            if ($sucesso) {
                echo "Registro incluído!";
            } else {
                $erro = "Erro ao inserir registro";
                //var_dump($std->errorInfo());
            }
        } catch (Exception $e) {
             $erro = "Erro ao inserir registro";
//            var_dump($e);
            //    die("Erro de conexão com o servidor!");
        }
    }

    if(!is_null($erro)){
        echo "
        <div class='alert alert-danger' role='alert'>
            $erro
        </div>";
    }
}

    ?>
    <!doctype html>
    <html lang="pt">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
              crossorigin="anonymous">

        <title>Cadastrar Questionários do desafío</title>
    </head>
    <body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Questionários</a>
        </nav>
    </div>
    <div class="container">
        <form method="post">
            <div class="form-group">
                <label for="formGroupExampleInput">Fase relacionada</label>
                <select class="form-control">
                    <option selected>Fases</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Titulo</label>
                <input type="text" class="form-control" id="formGroupExampleInput" name="titulo" placeholder="Titulo">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Tipo</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" name="tipo" placeholder="Tipo">
            </div>

            <div class="form-group row">
                <div class="col-sm-2">Status:</div>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck1" name="ativo" value="1">
                        <label class="form-check-label" for="gridCheck1">
                            Ativo
                        </label>
                    </div>
                </div>
            </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
        <a href="index.php">
            <button class="btn btn-primary disabled">Voltar</button></a>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    </body>
    </html>
