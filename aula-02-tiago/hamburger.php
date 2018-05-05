<?php

/*
 *  Missões de agora:
 * 1 - Exibir todas as avaliações da hamburgeria (caso existam)
 * 2 - Exibir todas as hamburgerias
 * > funções
 * > loops
 */

// Controlar
error_reporting(E_ALL ^ E_NOTICE);

function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

// Obter todas hamburgerias
// https://developers.google.com/places/web-service/details
$data = CallAPI("get",
    "https://good-burger-prod.herokuapp.com/api/hamburger/"
);
$hamburgerias = json_decode($data);
//var_dump($hamburgerias);
//die();

// Pegar apenas uma hamburgueria da lista
//$hamburgeria = $hamburgerias[1];

foreach ($hamburgerias as $hamburgeria)
    exibirHambuergeria($hamburgeria);
//exibirHambuergeria($hamburgerias[34]);

function exibirHambuergeria($hamburgeria)
{
    //echo "<pre>";
    //print_r($hamburgeria->place);
    //echo "</pre>";

    // Exibir dados da hamburgeria
    $weekAverage = ajustarValor($hamburgeria, 'weekAverage');
    $service = ajustarValor($hamburgeria, 'service');
    $ambiance = ajustarValor($hamburgeria, 'ambiance');
    $meat = ajustarValor($hamburgeria, 'meat');
    $price = ajustarValor($hamburgeria, 'price');
    $taste = ajustarValor($hamburgeria, 'taste');

    echo "<hr>
    <h1>{$hamburgeria->place->name}</h1>
    <small>{$hamburgeria->place->vicinity}</small>
    <div>
        Nota nesta semana: $weekAverage<br/>
        Sabor: $taste <br/>
        Atendimento: $service<br/>
        Ambientes: $ambiance<br/>
        Ponto da Carne: $meat<br/>
        Preço: $price<br/>
    </div>";

    $fotos = $hamburgeria->place->photos;
    //echo "<pre>";
    //var_dump($fotos);
    //echo "</pre>";

    echo "<h2>Fotos</h2>";
    echo "Existem " . count($fotos) . " deste local.<br>";

    foreach ($fotos as $foto) {
        exibirFoto($foto);
    }
}


function exibirFoto($photo)
{
    $urlFinal = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=300&key=AIzaSyBEK74-zUzXuVWkdzoNG5rV_wL2uOSneXc&photoreference=";
    $urlFinal = $urlFinal . $photo->photo_reference;
    ////var_dump($urlFinal);
    echo "<img src=$urlFinal style='width: 100px';>";
}

function ajustarValor($obj, $atributo)
{
    if (isset($obj->$atributo))
        return round($obj->$atributo);
    else
        return 0;
}



//for ($i=0; $i<count($fotos); $i++){
//    exibirFoto($fotos[$i]);
//}


//$urlFinal = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=300&key=AIzaSyBEK74-zUzXuVWkdzoNG5rV_wL2uOSneXc&photoreference=";
//$urlFinal = $urlFinal.$hamburgeria->place->photos[0]->photo_reference;
////var_dump($urlFinal);
//echo "<img src=$urlFinal style='width: 100px';>";
//


// Exemplo de array
//$alimentos = [
//    "frutas" => ["banana", "maça"],
//    "verduras" => "alface",
//    "beterraba"
//];
//var_dump($alimentos);
/*
 * $bernardo->filhos; // [{nome:"alice",idade:7},{nome:"tiago",idade:4,nomeEscola:"Jesuitos"}];
 * $bernardo->filhos[0]->idade; // 7
 * $bernardo->filhos[1]->escola->nome ; // "jesuitas"
 * $bernardo->filhos[1]->nomeEscola ; // "jesuitas"
 * $geronimo->pai->irmaos[0]->filhos[0]->nome; // yasmin
 * count($guilherme->mae->irmaos); // 5
 * count($guilherme->mae->mae->filhos); // 6
 * count($guilherme->avó->filhos); // 6
 * $leonardo->hasFilhos(); // true
 * $planetas['terra']->continentes['america']-......andar[4]->sala[0]->mesa[0]
 */


