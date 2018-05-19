<!DOCTYPE>
<html>
    <head>
        <meta charset='UTF-8'>
        <title>Trilha</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
              integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="header">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="#">Trilha</a>
                    <a class="navbar-brand" href="add.php">Adicionar</a>
                </nav>
            </div>
            <div class='containt'>
                <?php
                    require_once 'conexao.php';
                    require_once 'list.php';
                ?>
            </div>
        </div>
    </body>
</html>