<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List</title>
</head>
<body>
    <h1>Lista de Nomes</h1>
    <?php

        foreach ($registros as $registro) {
            echo "<p> $registro </p>";
    }

    ?>
</body>
</html>