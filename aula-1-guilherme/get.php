<?php
echo "<pre>";
    $estados = array(
        "mg" => "Minas Gerais",
        "rj" => "Rio de Janeiro"
    );
    //var_dump($estados);

    echo "<hr>";
    var_dump($_GET);

    $MoroEm = $_GET['estado'];
    $gostaDe = $_GET['gosta'];
    $Nomeestados = $estados[$MoroEm];


    echo "Eu gosto de $gostaDe, e moro em $Nomeestados <hr>";
