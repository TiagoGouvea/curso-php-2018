<?php
//   echo "Hello World ";

$nome = "Guilherme";
$idade = 27;
$vivo = true;
$peso = 80.5;
$pesoRaquel = 60.5;
global $pesoRaquel;

const planet = "terra <br> ";

function saudar($nome)
{
    global $pesoRaquel;
    echo "Olá $nome, voce pesa $pesoRaquel !! <br>";
}

saudar("raquel!");

require "segundo.php";
