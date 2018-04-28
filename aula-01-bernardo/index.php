<?php
echo "Hello World! <br>";

$nome = "Bernardo";
$idade = 36;
$vivo = true;
$peso = 110;
$pesoCris = 70;
global $pesoCris;


const planeta = "terra";

echo $nome . " Tem " . $idade . " anos e vive na " . planeta . '.' . "<br>";


function saudar($nome)
{
    global $pesoCris;
    echo "Ola $nome. voce pesa $pesoCris. <br>";
}

saudar("Cris");

require "segundo.php";
