<?php

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
$hamburgeria = $hamburgerias[1];
echo "<pre>";
//print_r($hamburgeria->place);
echo "</pre>";

// Exibir dados da hamburgeria
$hamburgeria->weekAverage = round($hamburgeria->weekAverage);
$hamburgeria->service = round($hamburgeria->service);
$hamburgeria->ambiance = round($hamburgeria->ambiance);
$hamburgeria->meat = round($hamburgeria->meat);
$hamburgeria->price = round($hamburgeria->price);
echo "<hr>
    <h1>{$hamburgeria->place->name}</h1>
    <small>{$hamburgeria->place->vicinity}</small>
    <div>
        Nota nesta semana: $hamburgeria->weekAverage<br/>
        Sabor: ".round($hamburgeria->taste)."<br/>
        Atendimento: $hamburgeria->service<br/>
        Ambientes: $hamburgeria->ambiance<br/>
        Ponto da Carne: $hamburgeria->meat<br/>
        Preço: $hamburgeria->price<br/>
    </div>
";

$fotos = $hamburgeria->place->photos;
//echo "<pre>";
//var_dump($fotos);
//echo "</pre>";

function exibirFoto($photo){
    $urlFinal = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=300&key=AIzaSyBEK74-zUzXuVWkdzoNG5rV_wL2uOSneXc&photoreference=";
    $urlFinal = $urlFinal.$photo->photo_reference;
    ////var_dump($urlFinal);
    echo "<img src=$urlFinal style='width: 100px';>";
}
echo "<h2>Fotos</h2>";
echo "Existem ".count($fotos)." deste local.<br>";

foreach ($fotos as $foto){
    exibirFoto($foto);
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


