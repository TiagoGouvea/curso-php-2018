<?php

session_start();
require 'vendor/autoload.php';

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
});

// LEO, INSERIR SEU GROUP

$app->group('/admin', function () {
    // Trilha
    $this->group('/pergunta', function () {
        $this->get('/', function ($req, $res, $args) {
            echo "Listar pergunta";
        });
        $this->get('/incluir', function ($req, $res, $args) {
            echo "Form para incluir pergunta";
        });
        $this->post('/incluir', function ($req, $res, $args) {
            echo "Código para acessar model e incluir no banco";
        });
        $this->get('/editar/{id}', function ($req, $res, $args) {
            echo "Form para editar a pergunta ".$args['id'];
        });
        $this->put('/editar/{id}', function ($req, $res, $args) {
            echo "Código para acessar model e alterar a pergunta $args[id] no banco";
        });
        $this->delete('/excluir/{id}', function ($req, $res, $args) {
            echo "Excluir a pergunta ".$args['id'];
        });
    });
});

$app->run();

//var_dump($_SERVER);