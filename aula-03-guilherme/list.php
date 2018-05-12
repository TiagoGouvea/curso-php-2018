<?php

require 'conexao.php';

if (count($_POST) > 0) {

    $erro = null;

    if (empty($_POST['titulo'] )) {
        $erro = "Título vazio";
    } else if (empty($_POST['tipo'] )) {
        $erro = "Tipo vazio";
    } else {
        try {
            // Salvar ele no banco de dados

            $sql = "select * from pergunta";
            $std = $db->prepare($sql);
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


//    <div class="alert alert-danger" role="alert">
//        This is a danger alert—check it out!
//    </div>


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

    <title>Hello, world!</title>
</head>
<body>
<div class="container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#">Cadastrar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Alterar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Consultar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#">Excluir</a>
        </li>
    </ul>
    <form method="post">
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
</div>
</form>

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
