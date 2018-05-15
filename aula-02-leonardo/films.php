<?php

require 'classes.php';

session_start();
 var_dump($_SESSION['filmes']);
//   $_SESSION['filmes'] = null;

//die();
error_reporting(E_ALL);

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

    $films = CallAPI("get",
        "https://swapi.co/api/films/");

    $films = json_decode($films);

    // echo "<pre>";
    // var_dump($films);
    // echo "<hr>";
    
    // Criando o array principal que será usado no restante do código, ele recebe os resultados presentes dentro do objeto films
    $films_arr = $films->results;

    echo "<pre>";
    // Traduzindo, transcrevendo um array de objetos stdClass (sem tipo) para um array com seus objetos Film
    
    // Criando a class Film que recebe os dados vindo do array dentro do film->results
    
    
    // Criado o array que recebera os objetos criados contendo os filmes
    $filmsObject = [];
    $characterObject = [];
    $planetsObject = [];
    $speciesObject = [];
    $vehiclesObject = [];
    $startshipsObject = [];
    $characters_arr;
    $planets_arr;
    $species_arr;
    $vehicles_arr;
    $startships_arr;
    
    /* o foreach cria os objetos da classe Filme recebendo o conteudo que existe dentro films-results
    * em seguida ele grava o objeto criado dentro do array filmesObjetos
    */
    foreach ($films_arr as $film_arr) {
        $film = new Film($film_arr);
        $filmsObject[]=$film;
        
        $characters_arr = $film_arr->characters;
        $planets_arr = $film_arr->planets;
        $species_arr = $film_arr->species;
        $vehicles_arr = $film_arr->vehicles;
        $startships_arr = $film_arr->startships;
        
        foreach ($characters_arr as $character_arr) {
            $character = new People($character_arr);
            $characterObject[] = $character;
            // echo "<hr><br/ >Aqui<br />";
            // var_dump($character);
            // echo "<hr>";
        }

        $film->characters = $characterObject;

        foreach ($planets_arr as $planet_arr) {
            $planet = new Planets($planet_arr);
            $planetsObject[] = $planet;
        }

        $film->planets = $planetsObject;

        foreach ($species_arr as $specie_arr) {
            $species = new Species($specie_arr);
            $speciesObject[] = $species;
            //var_dump($species_arr);
        }

        $film->species = $speciesObject;

        foreach ($vehicles_arr as $vehicle_arr) {
            $vehicles = new Vehicles($vehicle_arr);
            $vehiclesObject[] = $vehicles;
        }

        $film->vehicles = $vehiclesObject;

        foreach ($startships_arr as $startship_arr) {
            $startships = new Startships($startship_arr);
            $startshipsObject[] = $startships;
        }

        $film->startships = $speciesObject;
    }

    // o foreach abaixo serve apenas para imprimir na tela os films que estão gravados dentro do array de objetos
    // foreach($filmsObject as $film){
    //     var_dump($film);
    //     echo "<hr>";
    // }

    // o foreach abaixo serve apenas para imprimir na tela os personagens que estão gravados dentro do array de objetos
    // echo "<hr>";
    // foreach($characterObject as $character) {
    //     var_dump($character);
    // }
    $_SESSION['filmes'] = $filmsObject;
    var_dump($_SESSION);

?>