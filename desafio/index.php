<?php

session_start();
require 'vendor/autoload.php';
require 'model/Fases.php';

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$container = new \Slim\Container($configuration);

$app = new Slim\App($container);

$app->get('/', function ($req, $res, $args) {
    echo "Aqui terá um site";
});

$app->group('/admin', function () {
    // Trilha
    $this->group('/trilha', function () {
        $this->get('/', function ($req, $res, $args) {
            echo "Listar trilhas";
        });
        $this->get('/incluir', function ($req, $res, $args) {
            echo "Form para incluir trilha";
        });
        $this->post('/incluir', function ($req, $res, $args) {
            echo "Código para acessar model e incluir no banco";
        });
        $this->get('/editar/{id}', function ($req, $res, $args) {
            echo "Form para editar a trilha ".$args['id'];
        });
        $this->put('/editar/{id}', function ($req, $res, $args) {
            echo "Código para acessar model e alterar a trilha $args[id] no banco";
        });
        $this->delete('/excluir/{id}', function ($req, $res, $args) {
            echo "Excluir a trilha ".$args['id'];
        });
    });
    // LEO, INSERIR SEU GROUP
    // Trilha
    $this->group('/fases', function () {
        $this->get('/', function ($req, $res, $args) {
            $registros = Fases::getAll();
            require 'view/fases/list.php';

        });
        $this->get('/incluir', function ($req, $res, $args) {
            require 'view/fases/formAdd.html';

        });
        $this->post('/incluir', function ($req, $res, $args) {
            Fases::incluir($_POST);
            var_dump($_POST);
        });
        $this->get('/editar/{id}', function ($req, $res, $args) {
            echo "Form para editar a fases ".$args['id'];
        });
        $this->put('/editar/{id}', function ($req, $res, $args) {
            echo "Código para acessar model e alterar a fases $args[id] no banco";
        });
        $this->delete('/excluir/{id}', function ($req, $res, $args) {
            echo "Excluir a fases ".$args['id'];
        });
    });
});


$app->run();

//var_dump($_SERVER);