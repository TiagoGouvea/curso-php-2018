<?php

if (count($_POST) > 0) {

    var_dump($_POST);

    echo "<hr>";

    echo "Olá " . $_POST['nome'] . ", sua idade é " . $_POST['idade'];

} else {

    ?>

    <form method="post">
        Nome:<input type="text" name="nome"><br>
        Idade:<input type="text" name="idade"><br>
        <input type="submit" value="enviar">
    </form>
    <?php
}
?>