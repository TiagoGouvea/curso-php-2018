<?php
/**
 * Created by PhpStorm.
 * User: Bernardo
 * Date: 28/04/2018
 * Time: 17:41
 */

var_dump($_POST);
if (count($_POST )> 0) {
    echo "Olá" . $_POST ['nome'] . " voce tem " . $_POST ['idade'];
} else {
    ?>
    <form method="post">


        Nome:<input type="text " name="nome"><br>
        Idade: <input type="text" name="idade"><br>
        <input type="submit" value="Enviar">

    </form>
    <?php
}
?>