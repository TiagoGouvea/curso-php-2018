<?php
echo "<pre>";
$estados = array(
    "mg"=>"Minas Gerais",
    "rj"=>"Rio de Janeiro"
);
//var_dump($estados);
echo "<hr>";

var_dump($_GET);
$gostaDe = $_GET['gosta'];
$siglaEstado = $_GET['estado'];
$nomeEstado = $estados[$siglaEstado];

echo "Eu gosto de $gostaDe e moro em $nomeEstado<hr>";
