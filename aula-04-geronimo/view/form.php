<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Titulo</title>

</head>
<body>
<h1> Lista de Nomes</h1>
<?php
    foreach ($registros as $registro){
        echo $registro. "<br>";
    }
?>
</body>
</html>