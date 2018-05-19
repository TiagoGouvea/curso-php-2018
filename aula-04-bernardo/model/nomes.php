<?php
class Nome{
static function incluir ($nome){
    $_SESSION['nomes'][]= $nome;
}
static function getAll(){
    return $_SESSION['nomes'];
}
}