<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>List</title>
    </head>
    <body>
        <h1>Lista de Fases</h1>
        <?php

        foreach ($registros as $registro) {
            var_dump($registro);
            echo "<p>$registro->title</p>";
        }

        ?>
    </body>
</html>