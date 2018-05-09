<?php
//header('Content-Type: text/plain; charset=utf-8');

//$alimentos = [
//    "frutas" => ["banana", "maça"], "verduras" => "alface", "beterraba"];
//var_dump($alimentos);

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
    "https://good-burger-prod.herokuapp.com/api/hamburger/"
);
$data = json_decode($data);

var_dump($data);
die();
$hambugeria = $data[4];
//var_dump($hambugeria);

echo "<hr>        
       <h1 align='center'>{$hambugeria->place->name}</h1>
       <div align='center'>  
             Nota nesta semana: $hambugeria->weekAverage </br>   
             Sabor: $hambugeria->taste </br>    
             Atendimento: $hambugeria->service </br>     
             Ambiente: $hambugeria->ambiente </br> 
             Ponto da Carne: $hambugeria->meat </br>  
             Preco: $hambugeria->price </br>   
        </div>
";

$fotos = $hambugeria->place->photos;

function exibirFoto($photo){
    $urlFinal = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=300&key=AIzaSyBEK74-zUzXuVWkdzoNG5rV_wL2uOSneXc&photoreference=";
    $urlFinal = $urlFinal.$photo->photo_reference;
    ////var_dump($urlFinal);
    echo "<img src=$urlFinal style='width: 100px';>";
}

foreach ($fotos as $foto){
    exibirFoto($foto);
}

echo "<hr>";

$avaliacoes = $hambugeria->place->reviews;

function exibirAvaliacoes($avaliacao){

    echo " 
    <div align='center'> 
         Nota: {$avaliacao->rating} </br>
         Quando avaliou: {$avaliacao->relative_time_description} </br>
         Autor: {$avaliacao->author_name} </br>
         Avaliacao: {$avaliacao->text} </br>
    </div></br>
";
}
echo "<h2 align='center'>Descricões e Informações sobre o Local</h2>";

foreach ($avaliacoes as $item) {
    exibirAvaliacoes($item);
}

