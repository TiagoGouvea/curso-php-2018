<?php

session_start();
require 'vendor/autoload.php';
require 'model/Fases.php';
require 'lib/Db.php';
// Teste de autoloader do Tiago
//$trilha = new Model\Trilha();

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$container = new \Slim\Container($configuration);

$app = new Slim\App($container);

$app->get('/', function ($req, $res, $args) {
    require "view/Home.php";
});

$app->group('/admin', function () {
    // Trilha
    $this->group('/trilha', function () {
        require "model/Trilha.php";
        $this->get('/', function ($req, $res, $args) {
            echo "Listar trilhas";
        });
        $this->get('/incluir', function ($req, $res, $args) {
            echo "Form para incluir trilha";
        });
        $this->post('/incluir', function ($req, $res, $args) {
            //echo "Código para acessar model e incluir no banco";
            $ok = Trilha::cadastro($_POST);
            if($ok)
                return $res->withStatus(302)->withHeader("Location", "/curso-php-2018/curso-php-2018/desafio/admin/pergunta/");
            else
                echo "Erro ao incluir";
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

    // Fases
    $this->group('/fases', function () {
        $this->get('/', function ($req, $res, $args) {
            $result = Fases::getAll();
            require 'view/fases/formList.php';
        });
        $this->get('/incluir', function ($req, $res, $args) {
            require 'view/fases/formAdd.html';
        });
        $this->post('/incluir', function ($req, $res, $args) {
            Fases::incluir($_POST);
            $result = Fases::getAll();
            return $res->withStatus(302)->withHeader("Location", '/curso-php-2018/desafio/admin/fases/');
        });
        $this->get('/editar/{id}', function ($req, $res, $args) {
            //echo "Form para editar a fases ".$args['id'];
            Fases::add($args['id']);
        });
        $this->post('/editar/{id}', function ($req, $res, $args) {
            $status = Fases::edit($_POST);
            $result = Fases::getAll();
            return $res->withStatus(302)->withHeader("Location", '/curso-php-2018/desafio/admin/fases/');
        });
        $this->get('/excluir/{id}', function ($req, $res, $args) {
            Fases::delete($args['id']);
            $result = Fases::getAll();
            return $res->withStatus(302)->withHeader("Location", '/curso-php-2018/desafio/admin/fases/');
        });
    });

    // Perguntas
    $this->group('/pergunta', function () {
        require "model/Pergunta.php";
        $this->get('/inicio', function ($req, $res, $args) {
            $getAll = Pergunta::getAll();
            require "view/pergunta/list.php";
        });

        $this->get('/incluir', function ($req, $res, $args) {
            $var = Pergunta::getAll();
            require "view/pergunta/add.php";
        });

        $this->post('/incluir', function ($req, $res, $args) {
            require "view/pergunta/add.php";
            $ok = Pergunta::add($_POST);

            if($ok) return $res->withStatus(302)
                    ->withHeader("Location", "/curso-php-2018/curso-php-2018/desafio/admin/pergunta/inicio");
            else echo "Erro ao incluir";
        });

        $this->get('/editar/{id}', function ($req, $res, $args) {
            $result = Pergunta::getOne($args['id']);
            require "view/pergunta/edit.php";
        });

        $this->post('/editar/{id}', function ($req, $res, $args) {
            require "view/pergunta/edit.php";
            if(count($_POST)){
                Pergunta::edit($args['id']);
                return $res->withStatus(302)
                    ->withHeader("Location", "/curso-php-2018/curso-php-2018/desafio/admin/pergunta/inicio");
            }
        });

        $this->get('/excluir/{id}', function ($req, $res, $args) {
            $erro = Pergunta::delete($args['id']);
            if($erro){
                return $res->withStatus(302)
                    ->withHeader("Location", "/curso-php-2018/curso-php-2018/desafio/admin/pergunta/inicio");
            } else{
                $e = "Erro ao Excluir os dados";
                require "view/pergunta/excluir.php";
            }
        });
    });

    // Opções
    $this->group('/opcao', function () {
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