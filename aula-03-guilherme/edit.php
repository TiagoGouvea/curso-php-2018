<?php

require 'conexao.php';
var_dump($_GET);
echo "<br>";
var_dump($_POST);
echo "<br>";

try {

    if ($_POST) {

        $sql = "UPDATE `pergunta` SET `titulo` = :var2, `tipo` = :var3, `ativa` = :var4 
                  WHERE `pergunta`.`id` = :var1";
        $std = $db->prepare($sql);
        $std->bindParam(":var1", $_GET['id'], PDO::PARAM_INT);
        $std->bindParam(":var2", $_POST['titulo'], PDO::PARAM_STR);
        $std->bindParam(":var3", $_POST['tipo'], PDO::PARAM_STR);
        $std->bindParam(":var4", $_POST['ativo'], PDO::PARAM_STR);
        $success = $std->execute();

    }

    $sql = "SELECT * FROM pergunta where id = :var1";
    $std = $db->prepare($sql);
    $std->bindParam(":var1", $_GET['id'], PDO::PARAM_INT);
    $success = $std->execute();
    $result = $std->fetchAll(PDO::FETCH_OBJ);

    if (!$success) {
        echo "Erro ao Consultar registro";
    }

} catch (Exception $e) {
    echo "Erro ao inserir registro";
}
var_dump($sql);
?>
<!doctype html>
<html lang="pt">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Editar</title>
</head>
<body class="container">
<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Questionários</a>
    </nav>
</div>
<form method="post">
    <div class="form-group">
        <label for="formGroupExampleInput">Titulo</label>
        <input type='text' class='form-control'
               id='formGroupExampleInput' name='titulo' value="<?php
        foreach ($result as $item) {
            print($item->titulo);
        }
        ?>">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Tipo</label>
        <input type="text" class="form-control"
               id="formGroupExampleInput2" name="tipo" value='<?php
        foreach ($result as $item) {
            echo($item->tipo);
        }
        ?>'>
    </div>

    <div class="form-group row">
        <div class="col-sm-2">Status:</div>
        <div class="col-sm-10">
            <div class="form-check">
                <input class="form-check-input" type="checkbox"
                       id="gridCheck1" name="ativo" <?php
                foreach ($result as $item) {
                    if ($item->ativa) {
                        echo "checked";
                    }
                }
                ?>>
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