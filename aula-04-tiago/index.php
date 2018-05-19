<?php

session_start();
require 'vendor/autoload.php';

// Exemplo com Faker
//$faker = Faker\Factory::create();
//require "vendor/fzaninotto/faker/src/Faker/Factory.php";
//$faker = \Faker\Factory::create();
//echo "Olá ".$faker->name;

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$container = new \Slim\Container($configuration);

$app = new Slim\App($container);

$app->get('/ola/{name}', function ($req, $res, $args) {
    echo "Olá " . $args['name'];
});

$app->get('/incluir', function ($req, $res, $args) {
    require "list.php";
});

$app->post('/incluir', function ($req, $res, $args) {
    Nome::incluir($_POST['nome']); // <<<<<<<<<<<<
});

$app->get('/listar', function ($req, $res, $args) {
    $registros = Nome::getAll(); // <<<<<<<<<<<<
    require "list.php";
});

$app->run();

//var_dump($_SERVER);