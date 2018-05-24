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
                <div class='form-group'>
                    <input type='hidden' name='id'
                           value="<?php
                            foreach ($result as $item) {
                                echo $item->id;
                            }
                        ?>">
                    <label for='title'>Titulo</label>
                    <input type='text' class='form-control' id='title' placeholder='Insira o titulo' name='title' required
                        value="<?php
                            foreach ($result as $item) {
                                print $item->titulo;
                            }
                        ?>">
                </div>
                <div class='form-group'>
                    <label for='description'>Descrição</label>
                    <textarea type='text' class='form-control' id='description' placeholder='Insira a descrição da fase' rows='10' name='description' required
                        ><?php
                            foreach ($result as $item) {
                                echo $item->conteudo;
                            }
                        ?></textarea>
                </div>
                <div class='form-group''>
                    <label for='numFase'>Número da Fase</label>
                    <select class='form-control' id='numFase' name='order' required
                        ><?php
                            foreach ($result as $item) {
                                while ($i < 20) {
                                    $j = $i + 1;
                                    if ($j == $item->ordem) {
                                        //echo $order;
                                        echo "<option selected>{$item->ordem}</option>";
                                    } else
                                        echo "<option>{$j}</option>";
                                    $i++;
                                }
                            }
                        ?></select>
                </div>
                <div class='form-group form-check'>
                    <input type='checkbox' class='form-check-input' id='status' name='status'
                        <?php
                            foreach ($result as $item) {
                                if ($item->ativa == 1)
                                    echo "checked";
                            }
                        ?>
                    >
                    <label class='form-check-label' for='status'>Ativo</label>
                </div>
                <button type='submit' class='btn btn-primary'>Submit</button>
            </form>
        </div>
    </div>
</body>
</html>