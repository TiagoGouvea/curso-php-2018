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
        //curl_setopt($curl, CURLOPT_USERPWD, "username:password");
    
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
        $result = curl_exec($curl);
    
        curl_close($curl);
    
        return $result;
    }

    function getResults($obj) {
        $obj = CallAPI("get",
            "https://swapi.co/api/$obj/");

        $obj = json_decode($obj);
        return $obj;
    }

    $people = getResults('people');
    $planets = getResults('planets');
    $films = getResults('films');
    $species = getResults('species');
    $vehicles = getResults('vehicles');
    $startships = getResults('people');

    // echo "<pre>";
    // var_dump($films->results[0]);
    // echo "<hr>";
    // var_dump($people->results[0]);
    // echo "<hr>";
    // var_dump($species);
    // echo "<hr>";
    // var_dump($planets->results[0]->films);
    // echo "<hr>";
    // var_dump($vehicles);
    // echo "<hr>";
    // var_dump($startships);
    // echo "<hr>";

    // echo "</pre>";

    // people
    $namePeople = $people->results[0]->name;
    $urlPeople = $people->results[0]->url;
    
    // films
    $title = $films->results[0]->title;
    $episode = $films->results[0]->episode_id;
    $characters = $films->results[0]->characters[0];
    $planets = $films->results[0]->planets[0];

    // planets
    $namePlanets = $planets->results[1]->name;
    $urlPlanets = $planets->results[1]->url;
    var_dump($urlPlanets);
    
    echo "Episodio $episode - $title <br />";
    if ($characters === $urlPeople) {
        echo "Nome $namePeople <br />";
    }

    if ($planets === $urlPlanets) {
        echo "Planeta $namePlanets <br />";
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <title>Star Wars</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <style type='text/css'>
            .main {
                background-color: #000;
            }
            .title {
                color: #FFF;
            }
        </style>
    </head>
    <body>
            <div class='main'>
                <?php
                    echo "
                        <h1 class='title'>Star Wars</h1>
                    ";
                ?>
            </div>
    </body>
</html>