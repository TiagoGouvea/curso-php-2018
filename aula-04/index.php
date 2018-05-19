<?php

session_start();
require 'vendor/autoload.php';

// Exemplo com Faker
//$faker = Faker\Factory::create();
//require "vendor/fzaninotto/faker/src/Faker/Factory.php";
//$faker = \Faker\Factory::create();
//echo "Olá ".$faker->name;

$app = new Slim\App;

$app->get('/ola/{name}', function ($req, $res, $args) {
    echo "Olá " . $args['name'];
});

$app->get('/incluir', function ($req, $res, $args) {
    require "form.php";
});

$app->post('/incluir', function ($req, $res, $args) {
    $_SESSION['nomes'][] = $_POST['nome'];
    if (!isset($_SESSION['posts']))
        $_SESSION['posts'] = 0;
    $_SESSION['posts']++;
});

$app->get('/listar', function ($req, $res, $args) {
    $registros = $_SESSION['nomes'];
    require "list.php";
});

$app->run();

//var_dump($_SERVER);