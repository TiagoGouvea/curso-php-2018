<?php
/**
 * Created by PhpStorm.
 * User: Bernardo
 * Date: 28/04/2018
 * Time: 17:41
 */

var_dump($_POST);
if (count($_POST )> 0) {
    echo "<br>Olá " . $_POST ['nome'] . " você tem   " . $_POST ['idade']."  seu e-mail é  ". $_POST ['email'];
} else {
    ?>
    <form method="post">


        Nome:<input type="text " name="nome"><br>
        Idade: <input type="text" name="idade"><br>
        E-mail: <input type="text" name="email"><br>
        <input type="submit" value="Enviar">

    </form>
    <?php
}
?>