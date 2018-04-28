<?php
echo "Hello World! <br>";

// Variáveis
$nome = "Leonardo";
$idade = 35;
$vivo = true;
$peso = 80.8;
$pesoRaquel = 56.4;
global $pesoRaquel;

// Constantes
const planeta = "Terra";

echo "$nome tem $idade anos e vive na " . planeta . "<br>";

function saudar($nome, $idade)
{
    global $pesoRaquel;
    echo "$nome tem $idade anos, você pesa $pesoRaquel <br>";
}

saudar("João", 15);

require "segundo.php";
?>