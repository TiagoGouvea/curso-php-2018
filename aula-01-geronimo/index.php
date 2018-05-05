<?php

echo "Hello World!<br>"; // br quebra de linha

//Variaveis
$nome = "Geronimo"; // declarando variavel
$idade = 29;
$vivo = true;
$peso = 72;
$pesoRaquel = 70;
global $pesoRaquel;
//Constantes
const planeta = "Terra";

echo "$nome tem $idade anos e vive na " . planeta ."<br>";

//echo $nome. "tem" .$idade. "anos";     mostra o valor da variavel

function saudar($nome)
{
    global $pesoRaquel;
    echo "Olá $nome! você pesa $pesoRaquel!<br>";
}

require "segundo.php";