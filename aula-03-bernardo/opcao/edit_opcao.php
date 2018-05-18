<?php


require 'conexao.php';
var_dump($_GET);
echo "<br>";
var_dump($_POST);
echo "<br>";

try {

    if ($_POST) {

        $sql = "update opcao set (titulo,correta, ativa) values (:titulo,:correta,:ativa) where opcao . id = :idopcao";
        $std = $db->prepare($sql);
        $std->bindParam(":idopcao", $_GET[':idopcao'], PDO::PARAM_INT);
        $std->bindParam(":titulo", $_POST['titulo'], PDO::PARAM_STR);
        $std->bindParam(":correta", $_POST['correta'], PDO::PARAM_BOOL);
        $std->bindParam(":ativa", $_POST['ativa'], PDO::PARAM_BOOL);
        $sucesso = $std->execute();


    }

    $sql = "SELECT * FROM opcao where id = :idopcao";
    $std = $db->prepare($sql);
    $std->bindParam(":idopcao", $_GET['id'], PDO::PARAM_INT);
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
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
          crossorigin="anonymous">

    <title>Opção</title>
</head>
<body>
<form method="post">

    <div class="form-group col-md-6" style="margin-left: 25px;">
        <label for="exampleFormControlInput1">Resposta</label>
        <input type="text" name="titulo" class="form-control" id="titulo">

    </div>
    <div class="form-row col-md-6 ">
        <div class="col-sm-1" style="margin-left: 60px;">
            <label for="exampleFormControlInput1">Correta</label>
            <input type="checkbox" name="correta" class="form-control" id="correta">
        </div>
        <div class="col-sm-1" style="margin-left: 120px;">
            <label for="exampleFormControlInput1">Ativa</label>
            <input type="checkbox" name="ativa" class="form-control" id="ativa" value="1" checked>
        </div>

    </div></br>

    <button type="submit" style="margin-left: 40px;" px class="btn btn-primary ">Submit</button>

</form>
</body>
</html>