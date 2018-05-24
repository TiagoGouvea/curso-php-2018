<?php
session_start();
require 'vendor/autoload.php';
require 'nomes.php';
//$faker = Faker\Factory::create();
//var_dump($faker);
$app = new Slim\App;
$app->get('/ola', function($req, $res,$arg){
    echo "Olá";
});

$app->get('/incluir', function($req, $res,$arg){
    require "list.php";
});

$app->post('/incluir', function($req, $res,$arg){
Nome::incluir($_POST['nome']);

});

$app->get('/listar', function($req, $res,$arg) {
    $registros = Nome::getAll();
    require "list.php";
});

$app->run();