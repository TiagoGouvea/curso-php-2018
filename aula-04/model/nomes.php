<?php

class Nome{

    // Adiciona um nome na sessão
    static function incluir($nome){
        $_SESSION['nomes'][] = $nome;
    }

    // Retorna todos os nomes da sessão
    static function getAll($nome){
        return $_SESSION['nomes'];
    }
}