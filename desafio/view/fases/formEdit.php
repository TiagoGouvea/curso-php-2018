<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fases</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="header">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Fases</a>
                <a class="navbar-brand" href="incluir">Adicionar</a>
            </nav>
        </div>
        <div class='containt'>
            <form method="post" action='Fases.php'>
                <input type="hidden" name="method" value="put">
                <?php
//                    var_dump($result[0]->titulo);
                    foreach ( $result as $item) {
                        var_dump($item);
//                        $status = $item->ativa
//                        if ($status != '1')
//                            $status = false;
//                        else
//                            $status = true;
                        echo "
                            <div class='form-group'>
                                <label for='title'>Titulo</label>
                                <input type='text' class='form-control' id='title' placeholder='Insira o titulo' name='title' required value={$item->titulo}>
                            </div>
                            <div class='form-group'>
                                <label for='description'>Descrição</label>
                                <textarea type='text' class='form-control' id='description' placeholder='Insira a descrição da fase' rows='10' name='description' required >$item->conteudo</textarea>
                            </div>
                            <div class='form-group''>
                                <label for='numFase'>Número da Fase</label>
                                <select class='form-control' id='numFase' name='numFase' required>
                            ";
                                        while ($i < 20) {
                                            $j = $i + 1;
                                            if ($j == $item->ordem) {
                                            //echo $order;
                                            echo "<option selected>{$item->ordem}</option>";
                                            }
                                            echo "<option>{$j}</option>";
                                            $i++;
                                        }
                            echo "
                                </select>
                            </div>
                            <div class='form-group form-check'>
                                <input type='checkbox' class='form-check-input' id='status' name='status' value={$item->ativa} checked>
                                <label class='form-check-label' for='status'>Ativo</label>
                            </div>
                            <button type='submit' class='btn btn-primary'>Submit</button>
                        ";
                    }
                ?>
            </form>
        </div>
    </div>
</body>
</html>