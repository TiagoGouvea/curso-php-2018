<?php
/*
 * Explicar o arquivo inteiro
 */

// echo "Hello World!<br>";
// Variáveis
$idade = 36;
$vivo = true;
$peso = 83.5;
$nome = "Tiago";
$pesoRaquel = 70;
global $pesoRaquel;
// Constante
const planeta = "terra";

// String
//echo $nome." tem ".$idade." anos";
echo "$nome tem $idade anos e vive na " . planeta . "<br>";
//echo '$nome tem $idade anos';

function saudar($nome)
{
    global $pesoRaquel;
    echo "Olá $nome, você pesa $pesoRaquel!<br>";
}

require "segundo.php";