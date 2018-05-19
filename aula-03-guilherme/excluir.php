<?php

require 'conexao.php';

$erro = null;

try {
    // Salvar ele no banco de dados

    $sql = "DELETE FROM `pergunta` WHERE `id` = :var1";
    $std = $db->prepare($sql);
    $std->bindParam(":var1", $_GET['id'], PDO::PARAM_INT);
    $success = $std->execute();

    if ($success) {
        $erro =  "Registro excluido!";
    } else {
        $erro =  "Erro ao excluir registro";
    }
} catch (Exception $e) {
    $erro = "Erro ao excluir registro";
}

?>
<!doctype html>
<html lang="pt">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Excluir Questionário</title>
</head>
<body class="container">
<div >
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Questionários</a>
    </nav>
</div>
<div class="alert alert-danger" role="alert">
    <?php echo $erro ?>
</div>
    <a href="index.php"><button type="button" class="btn btn-primary">Voltar</button></a>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>