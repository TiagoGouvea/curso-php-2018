<!DOCTYPE>
<html>
<head>
    <meta charset='UTF-8'>
    <title>Trilha</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Trilha</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Curiosidades</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Fases
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
<?php

require 'conexao.php';

if (count($_POST) > 0) {

    try {
        // Salvar ele no banco de dados
        $sql = "insert into trilha (titulo,descricao,ativa) values (:titulo,:descricao,:ativa)";
        $std = $db->prepare($sql);
        $std->bindParam(":titulo", $_POST['titulo'], PDO::PARAM_STR);
        $std->bindParam(":descricao", $_POST['descricao'], PDO::PARAM_STR);
        $std->bindParam(":ativa", $_POST['ativa'], PDO::PARAM_BOOL);
        $sucesso = $std->execute();
        if ($sucesso) {
            echo "Registro incluído!";
        } else {
            echo "Erro ao incluir!";
            var_dump($std->errorInfo());
        }

    } catch (Exception $e) {
        var_dump($e);
        //    die("Erro de conexão com o servidor!");
    }


    //    var_dump($_POST);

    echo "<hr>";

    echo "O titulo é " . $_POST['titulo'] . "a descricao é " . $_POST['descricao'];

} else {

    ?>
    <form method='post'>
        <div class="form-row">
            <div class="col">
                <input type="text" name="titulo" class="form-control" placeholder="Titulo">
            </div>
        </div>

        Descrição:<textarea name='descricao'></textarea><br>

        <label class="form-check-label" for="gridCheck">
            Ativa1
        </label>
        <input class="form-check-input" type="checkbox" id="gridCheck" name="ativo" value="1">
        <br>


        <input type='submit' value='Enviar'/>
    </form>
    <?php
}
//echo  "O titulo é ".$_POST['titulo']. "a descricao é ".$_POST['descricao']. "a ativa está". $_POST['ativa'];
?>
</body>
</Html>