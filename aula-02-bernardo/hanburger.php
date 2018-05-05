<?php
/**
 * Created by PhpStorm.
 * User: Bernardo
 * Date: 05/05/2018
 * Time: 14:28
 */


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

$hamburgerias= json_decode($data);
//echo "<pre>";
//var_dump($data);
//"</pre>";
$hamburgeria= $hamburgerias[0];
echo "<pre>";
var_dump($hamburgeria);
"</pre>";

//exibir dados da hanmburgeria

echo "<hr>        
       <h1>{$hamburgeria->place->name}</h1>
       <small>{$hamburgeria->place->vicinity}</small>
       <div>  
             Nota nesta semana: $hamburgeria->weekAverage </br>   
             Sabor: $hamburgeria->taste </br>    
             Atendimento: $hamburgeria->service </br>     
             Ambiente: $hamburgeria->ambiente </br> 
             Ponto da Carne: $hamburgeria->meat </br>  
             Preco: $hamburgeria->price </br>   
        </div>
";
echo "<pre>";
var_dump($hamburgeria->place->photos[0]->photo_reference);
"</pre>";
