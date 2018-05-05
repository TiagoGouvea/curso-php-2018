<?php
    if(count($_POST)>0){
        echo "<br>Olá ".$_POST['nome'].", voce tem ".$_POST['idade']." anos";
    } else {

        //var_dump($_POST);
        ?>

        <form method="post">
            Nome: <input type="text" name="nome"><br>
            Idade: <input type="text" name="idade"><br>
            <input type="submit" name="Enviar">
        </form>
        <?php
    }
    ?>