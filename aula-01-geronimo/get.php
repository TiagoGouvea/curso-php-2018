<?php

echo "<pre>";

$estados = array
    (
        "mg" => "Minas Gerais",
        "rj" => "Rio de Janeiro"
    );
//var_dump ($estados);

echo "<hr>";

var_dump ($_GET); //variavel super global e explica o que ela é

$gostaDe = $_GET['gosta'];
$meuNome = $_GET['nome'];
$siglaEstado = $_GET ['estado'];
$nomeEstado = $estados[$siglaEstado];

echo "$meuNome gosto de $gostaDe e moro em $nomeEstado <hr>";