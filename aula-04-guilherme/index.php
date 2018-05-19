<?php

session_start();

require "vendor/autoload.php";
require "Nome.php";

//$Faker = Faker\Factory::create();
//
//var_dump($Faker);

$app = new Slim\App;

$app->get('/ola', function ($req, $res, $arg){
    echo "Ola";
});

$app->GET('/incluir', function ($req, $res, $arg){
    require "form.php";
});

$app->POST('/incluir', function ($req, $res, $arg){
    Nome::incluir($_POST['nome']);
});

$app->GET('/listar', function ($req, $res, $arg){
    $registro = Nome::getAll();
    require "list.php";
});

$app->run();