<?php

class Nome{
    static function incluir($nome){
        $_SESSION['nome'][] = $_POST['nome'];
    }

    static function getAll(){
        return $_SESSION['nome'];
    }


}