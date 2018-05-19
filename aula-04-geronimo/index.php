<?php

session_start(); // cria no servidor um arquivo pra você especifico para aquele

require 'vendor/autoload.php';
require 'nomes.php';

/*    $faker = Faker\Factory::create();
    echo "<pre>";
    echo "Olá ". $faker->name;*/

$app = new Slim\App;

// ____________________________________________________________ //

$app->get('/ola/{name}', function ($req, $res, $args) { // aqui eu declaro as minhas rotas
    echo "Olá! " . $args ['name'];
});


//______________________________________________________________//

$app->get('/incluir', function ($req, $res, $args) { // aqui eu declaro as minhas rotas
    require 'form.php'; // aqui usei o html mas normalmente é com php
});


//______________________________________________________________//

$app->post('/incluir', function ($req, $res, $args) { // aqui eu declaro as minhas rotas
  Nome::incluir($_POST['nome']);
});

//______________________________________________________________//

$app->get('/listar', function ($req, $res, $args) { // aqui eu declaro as minhas rotas

    $registros = Nome::getAll();
    require 'list.php';
});

$app->run();