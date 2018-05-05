<?php
//var_dump($_POST);
if (count($_POST)>0) {
    echo "Olá " . $_POST['nome'] . ", você tem " . $_POST['idade'] . " anos";
} else {
    ?>
    <form method="post">
        Nome: <input type="text" name="nome"><br>
        Idade: <input type="text" name="idade"><br>
        <input type="submit" value="Enviar">
    </form>
    <?php
}