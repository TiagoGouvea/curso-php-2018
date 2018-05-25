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
        <a class="navbar-brand" href="inicio">Opções</a>
    </nav>
</div class = "container">
<form method="post">
    <div class="form-group">
        <label for="formGroupExampleInput">Opções</label>
        <input type="text"  class="form-control" name="titulo">
    </div>

    <div class="form-group row">
        <div class="col-sm-2">Status 1:</div>
        <div class="col-sm-10">
            <div class="form-check">
                <input class="form-check-input" type="checkbox"
                       id="gridCheck1" name="correta"
                <label class="form-check-label" for="gridCheck1">
                    Ativa
                </label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2">Status 2:</div>
        <div class="col-sm-10">
            <div class="form-check">
                <input class="form-check-input" type="checkbox"
                       id="gridCheck1" name="ativa"
                <label class="form-check-label" for="gridCheck1">
                    Correta
                </label>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>
<!--<div class="alert alert-danger" role="alert">-->
<!--    <?php //echo $erro ?> -->
<!--</div>-->

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