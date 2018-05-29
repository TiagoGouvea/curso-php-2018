<?php
/*
 * Arquivo principal do projeto.
 * Todas requisições passam por aqui.
*/

require 'vendor/autoload.php';
require 'lib/Setup.php';
// Teste de autoloader do Tiago
//$trilha = new Model\Trilha();

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$container = new \Slim\Container($configuration);

$app = new Slim\App($container);

// Carregar dependencias do Slim
require 'lib/Dependencias.php';

$app->get('/', function ($req, $res, $args) {
    $registros = Trilha::getAllOrOne();
    $conteudo = $this->view->fetch('site/home.twig', ["registros"=>$registros]);
    return $this->view->render($res,'site/layout.twig',["conteudo"=>$conteudo]);
});

$app->group('/admin', function () {

    // Home do Admin - Com a view de Login/Senha -
    // Sera preciso criar a validação dos dados
    $this->get('/', function ($req, $res, $args) {
        return $this->view->render($res,'admin/login.twig');
    });

// -------------<>--------------- //

    // Endpoint de teste (do twig)
    $this->get('/teste/', function ($req, $res, $args) {
        $conteudo = $this->view->fetch('admin/teste.twig', ["nome"=>"Tiago Gouvea"]);
        return $this->view->render($res,'admin/layout.twig',["conteudo"=>$conteudo]);
    });

// -------------<>--------------- //

    // Trilha
    $this->group('/trilha', function () {
        $this->get('/', function ($req, $res, $args) {
            $registros = Trilha::getAllOrOne();
            $conteudo = $this->view->fetch(
                'trilha/lista.twig',
                ["registros"=>$registros]
            );
            return $this->view->render($res,'admin/layout.twig',["conteudo"=>$conteudo]);
        });

        $this->get('/incluir', function ($req, $res, $args) {
            $conteudo = $this->view->fetch(
                'trilha/form.twig'
            );
            return $this->view->render($res,'admin/layout.twig',["conteudo"=>$conteudo]);
        });
        $this->post('/incluir', function ($req, $res, $args) {
            //echo "Código para acessar model e incluir no banco";
            $ok = Trilha::cadastro($_POST);
            if ($ok)
                return $res->withStatus(302)->withHeader("Location", "/curso-php-2018/desafio/admin/trilha/");
            else
                echo "Erro ao incluir";
        });
        $this->get('/editar/{id}', function ($req, $res, $args) {
            $registro = Trilha::getAllOrOne($args['id']);
            $conteudo = $this->view->fetch(
                'trilha/form.twig',
                ['registro'=>$registro]
            );
            return $this->view->render($res,'admin/layout.twig',["conteudo"=>$conteudo]);
        });
        $this->post('/editar/{id}', function ($req, $res, $args) {
            $ok = Trilha::salvar($args['id'],$_POST);
            if ($ok)
                return $res->withStatus(302)->withHeader("Location", "/curso-php-2018/desafio/admin/trilha/");
            else
                echo "Erro ao salvar";

        });
        $this->get('/excluir/{id}', function ($req, $res, $args) {
            $ok = Trilha::excluir($args['id']);
            if ($ok)
                return $res->withStatus(302)->withHeader("Location", "/curso-php-2018/desafio/admin/trilha/");
            else
                echo "Erro ao salvar";
        });

        // Fases - em Trilhas
        $this->get('/{id}/fases/', function ($req, $res, $args) {
            $registros = Fases::getByTrilha($args['id']);
            $conteudo = $this->view->fetch(
                'fases/lista.twig',
                ["registros"=>$registros]
            );
            return $this->view->render($res,'admin/layout.twig',["conteudo"=>$conteudo]);
        });
    });

    // -------------<>--------------- //

    // Fases
    $this->group('/fases', function () {

        // Esta rota não faz mas sentido
//        $this->get('/', function ($req, $res, $args) {
//            $result = Fases::getAll();
//            require 'view/fases/formList.php';
//        });

//     ---------- MÉTODO ANTIGO ----------- //
//        $this->get('/incluir', function ($req, $res, $args) {
//            require 'view/fases/formAdd.html';
//        });

//     ---------- MÉTODO NOVO ------------- //

        $this->get('/incluir', function ($req, $res, $args) {
            $conteudo = $this->view->fetch(
                'fases/form.twig'
            );
            return $this->view->render($res,'admin/layout.twig',["conteudo"=>$conteudo]);
        });
//      ----------------------------------- //
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

        // Perguntas em Fases
        $this->get('/{id}/perguntas/', function ($req, $res, $args) {
            $registros = []; // Ajustar > Fases::getByTrilha($args['id']);
            $conteudo = $this->view->fetch(
                'fases/lista.twig',
                ["registros"=>$registros]
            );
            return $this->view->render($res,'admin/layout.twig',["conteudo"=>$conteudo]);
        });

    });

    // -------------<>--------------- //

    // Perguntas
    $this->group('/pergunta', function () {
         //variável conteúdo referece ao local onde sera inserido o conteúdo
        $this->get('/', function ($req, $res, $args) {
            $registros = Pergunta::getAllOrOne($args[null]);
            $conteudo = $this->view->fetch('pergunta/list.twig', ["registros"=>$registros]);
            return $this->view->render($res,'admin/layout.twig',["conteudo"=>$conteudo]);
        });

        $this->get('/incluir', function ($req, $res, $args) {
            $var2 = Pergunta::getNomeFases();
            $conteudo = $this->view->fetch('pergunta/add.twig', ["registros"=>$var2]);
            return $this->view->render($res,'admin/layout.twig',["conteudo"=>$conteudo]);
        });

        $this->post('/incluir', function ($req, $res, $args) {
            $ok = Pergunta::add($_POST);

            if ($ok) return $res->withStatus(302)
                ->withHeader("Location", "/curso-php-2018/curso-php-2018/desafio/admin/pergunta/");
                else echo "Erro ao incluir";
        });

        $this->get('/editar/{id}', function ($req, $res, $args) {
            $result = Pergunta::getAllorOne($args['id']);
            $conteudo = $this->view->fetch('pergunta/edit.twig', ['result'=>$result]);
            return $this->view->render($res,'admin/layout.twig',["conteudo"=>$conteudo]);
        });

        $this->post('/editar/{id}', function ($req, $res, $args) {
            require "view/pergunta/edit.php";
            if (count($_POST)) {
                Pergunta::edit($args['id']);
                return $res->withStatus(302)
                    ->withHeader("Location", "/curso-php-2018/curso-php-2018/desafio/admin/pergunta/");
            }
        });

        $this->get('/excluir/{id}', function ($req, $res, $args) {
            $erro = Pergunta::delete($args['id']);
            if ($erro) {
                return $res->withStatus(302)
                    ->withHeader("Location", "/curso-php-2018/curso-php-2018/desafio/admin/pergunta/");
            } else {
                $e = "Erro ao Excluir os dados";
                require "view/pergunta/excluir.php";
            }
        });

        // Opções em Pergunta
        $this->get('/{id}/opcoes/', function ($req, $res, $args) {
            $registros = []; // Ajustar
            $conteudo = $this->view->fetch(
                'fases/lista.twig',
                ["registros"=>$registros]
            );
            return $this->view->render($res,'admin/layout.twig',["conteudo"=>$conteudo]);
        });
    });

    // -------------<>--------------- //

    // Opções
    $this->group('/opcao', function () {
        require "model/Opcao.php";

        // Esta rota não faz mas sentido
//        $this->get('/', function ($req, $res, $args) {
//            $resultado = Opcao::listar();
//            require "view/opcao/list.php";
//
//        });
        $this->get('/incluir', function ($req, $res, $args) {
            require "view/opcao/form.php";

        });
        $this->post('/incluir', function ($req, $res, $args) {
            $ok = Opcao::cadastrar($_POST);
            if ($ok)
                return $res->withStatus(302)->withHeader("Location", "/curso-php-2018/desafio/admin/opcao/");
            else
                echo "Erro ao incluir";
        });
        $this->get('/editar/{id}', function ($req, $res, $args) {
            $resultado = Opcao::listarPorId($args['id']);
          //  echo "Form para editar a Opção " . $args['id'];
            //var_dump($resultado);
            require "view/opcao/edit.php";
        });
        $this->post('/editar/{id}', function ($req, $res, $args) {
            echo "Código para acessar model e alterar a opção $args[id] no banco";
            //var_dump($_POST, $args['id']);
            //exit();
            $ok = Opcao::editar($_POST, $args['id']);

            if ($ok)
                return $res->withStatus(302)->withHeader("Location", "/curso-php-2018/desafio/admin/opcao/");

            else
                echo "Erro ao incluir";
            var_dump($ok);
        });
        $this->delete('/excluir/{id}', function ($req, $res, $args) {
            echo "Excluir a fases " . $args['id'];
        });
    });
});

$app->run();