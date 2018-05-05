<?php

function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
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

$data = CallAPI("get",
    "https://good-burger-prod.herokuapp.com/api/hamburger/");

//echo "<pre>";

// codificando a string em JSON
$data = json_decode($data);
//var_dump($data);

// matando o a apresentação anterior
//die();

//buscar a hambuegueria de chave 0
//$hamburgueria = $data[1];


function exibirHamburguerias($hamburgueria)
{


//var_dump(($hamburgueria));
//print_r($hamburgueria->place->photos);

    $hamburgueria->weekAverage = round($hamburgueria->weekAverage);
    $hamburgueria->taste = round($hamburgueria->taste);
    $hamburgueria->service = round($hamburgueria->service);
    $hamburgueria->ambience = round($hamburgueria->ambience);
    $hamburgueria->meat = round($hamburgueria->meat);
    $hamburgueria->price = round($hamburgueria->price);


// buscando os atributos da hamburgueria
    echo "<hr>
    <h1>Nome: {$hamburgueria->place->name}</h1>
    <small>{$hamburgueria->place->vicinity}</small>
    <div>
      Nota esta semana: $hamburgueria->weekAverage <br />
      Sabor: $hamburgueria->taste <br />
      Atendimento: $hamburgueria->service <br />
      Ambiente: $hamburgueria->ambience <br />
      Ponto da Carne: $hamburgueria->meat <br />
      Preço: $hamburgueria->price <br />
      <h2>Avaliações</h2>
    </div>
";

    $avaliacoes = $hamburgueria->place->reviews;
//var_dump($available);



    foreach ($avaliacoes as $avaliacao) {
        exibirAvailable($avaliacao);
    }


    $fotos = $hamburgueria->place->photos;
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
    echo "<img src=$urlFinal style='width: 100px';> <br>";
}

function exibirAvailable($avaliacao)
{
    echo "Autor: " . $avaliacao->author_name;
    echo "<img src=$avaliacao->profile_photo_url style='width:20'/> <br>";
    echo $avaliacao->text . "<br>";
    echo "Comentado a " . $avaliacao->relative_time_description . " ";
    echo "<br><hr>";
}

foreach ($data as $hamburgueria) {
    exibirHamburguerias($hamburgueria);
}
//
//$alimentos = [
//    'frutas' => ['banana', 'maça'],
//    'verduras' => 'alface',
//    'beterraba'
//];
//
//var_dump($alimentos);
