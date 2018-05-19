<?php
 class Nome
 {
     static function incluir($nome)
     {
        $_SESSION["nome"][] = $nome;
     }

     static function getAll()
     {
         return $_SESSION['nomes'];
     }
 }