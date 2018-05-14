<?php


require 'conexao.php';

if(count($_POST)>0) {
    try {
// Salvar ele no banco de dados
        $sql = "insert into opcao (titulo,correta, ativa) values (:titulo,:correta,:ativa)";
        $std = $db->prepare($sql);
        $std->bindParam(":titulo", $_POST['titulo'], PDO::PARAM_STR);
        $std->bindParam(":correta", $_POST['correta'], PDO::PARAM_BOOL);
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
}
else{
?>

<!doctype html>
<html lang="pt">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <title>Opção</title>
</head>
<body>
<form method="post">
    <div class="form-group">
        <label for="exampleFormControlInput1">Título</label>
        <input type="text" name="titulo" class="form-control" id="titulo">

    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Correta</label>
        <input type="checkbox" name="correta" class="form-control" id="correta">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Ativa</label>
        <input type="checkbox" name="ativa" class="form-control" id="ativa" value="1" checked>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>
<?php
}