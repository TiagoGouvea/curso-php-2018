<?php

var_dump($_GET);
echo "<pre>";
//
$estados = array(
    "mg" => "Minas Gerais",
    "rj" => "Rio de Janeiro"
);

echo "<hr>";

var_dump($estados);
//
echo "<hr>";
//
//var_dump($_GET);
//
//echo "<hr>";
//
//$cidade = $_GET['cidade'];
//
//echo $cidade;

$gosta = $_GET['gosta'];

$nome = $_GET['nome'];

$siglaEstado = $_GET['estado'];
$nomeEstado = $estados[$siglaEstado];

echo "Eu $nome gosto de $gosta e moro em $nomeEstado";