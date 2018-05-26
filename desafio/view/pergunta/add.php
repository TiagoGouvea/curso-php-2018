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

        <title>Cadastrar Questionários</title>
    </head>
    <body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="inicio">Questionários</a>
        </nav>
    </div>
    <div class="container">
        <form method="post">
            <div class="form-group">
                <label for="formGroupExampleInput">Fase relacionada</label>
                <select class="form-control" name="id_fase">
                    <?php foreach ($var2 as $item)
                        echo "<option value='{$item->id_fase}'>{$item->titulo}</option>";
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Titulo</label>
                <input type="text" class="form-control" id="formGroupExampleInput" name="tituloPergunta" placeholder="Titulo">
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
        <a href="index.php">
            <button class="btn btn-primary disabled">Voltar</button></a>
        </form>
    </div>

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
