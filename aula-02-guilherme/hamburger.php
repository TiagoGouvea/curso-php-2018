<?php
//header('Content-Type: text/plain; charset=utf-8');
echo "<pre>";
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

//var_dump($data);

$hambugeria = $data[0];
var_dump($hambugeria);

echo "<hr>        
       <h1>{$hambugeria->place->name}</h1>
       <small>{$hambugeria->place->vicinity}</small>
       <div>  
             Nota nesta semana: $hambugeria->weekAverage </br>   
             Sabor: $hambugeria->taste </br>    
             Atendimento: $hambugeria->service </br>     
             Ambiente: $hambugeria->ambiente </br> 
             Ponto da Carne: $hambugeria->meat </br>  
             Preco: $hambugeria->price </br>   
        </div>
";




