
<?php
echo "<pre>";
    $estados = array(
        "mg" => "Minas Gerais",
        "rj" => "Rio de Janeiro"
    );
    $cidade = array(
        "mg" => "Juiz de Fora",
        "rj" => "Rio de Janeiro"
    );
    //var_dump($estados);

    echo "<hr>";
    var_dump($_GET);

    $MoroEm = $_GET['estado'];
    $CidadeEm = $_GET['cidade'];
    $Nomeestados = $estados[$MoroEm];
    $Nomecidade = $cidade[$CidadeEm];

    if(count($_GET)<0){
        echo "VAZIO";
    } elseif ($MoroEm != $CidadeEm){
        echo "Cidade não faz parte do Estado";
    } else{
        echo "Eu moro em $Nomeestados, na cidade de $Nomecidade <hr>";
    }