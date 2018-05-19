<?php
require 'conexao_opcao.php';



try {
        $sql = "SELECT * FROM opcao ";
        $std = $db->prepare($sql);
        $successo = $std->execute();

        if ($successo) {
            $result = $std->fetchAll(PDO::FETCH_OBJ);
            var_dump($result);
        } else {
            echo "Erro na busca";
        }
    } catch (Exception $e) {
        var_dump($e);
    }

if (count($_POST) > 0) {
    try {
// atualizar no banco de dados.
        $sql = "update opcao set (titulo,correta, ativa) values (:titulo,:correta,:ativa)where id = :idopcao";
        $std = $db->prepare($sql);
        $std->bindParam(":idopcao", $_GET['id'], PDO::PARAM_INT);
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
} else {
    ?>

    <!doctype html>
    <html lang="pt">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
              integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
              crossorigin="anonymous">

        <title>Editar resposta</title>
    </head>
    <body>
           <div class="form-group" >
            <label for="exampleFormControlInput1">Resposta</label>
            <select name="titulo" class="form-control">
                <?php foreach ($result as $item=> $value):?>
                <?php echo "<option value =\" $item\"> $value</option>"; ?>
                <?php endforeach; ?>
            </select>

        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Correta</label>
            <input type="checkbox" name="correta" class="form-control" value = >
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Ativa</label>
            <input type="checkbox" name="ativa" class="form-control"  value= >
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </body>
    </html
    <?php
}