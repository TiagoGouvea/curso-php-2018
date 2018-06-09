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


///////////// AUTENTICACAO E LOGIN //////////////////////

$app->get('/entrar/', function ($req, $res, $args) {
    echo $this->view->fetch('admin/login.twig');
});

$app->post('/entrar/', function ($req, $res, $args) {
    $usuario = Usuario::getByEmail($_POST['email']);
    $erro = null;
    if ($usuario && $usuario->senha == $_POST['senha']) {
        $_SESSION["usuario"] = $_POST['email'];
        $_SESSION["id_usuario"] = $usuario->id;
        return $res->withStatus(302)
            ->withHeader("Location", $_ENV["base_url"]);
    } else if ($usuario) {
        $erro = "Senha inválida";
    } else {
        $erro = "Usuário não encontrado";
    }
    echo $this->view->fetch('admin/login.twig', ["error" => $erro]);
});

$app->get('/cadastrar/', function ($req, $res, $args) {
    require('view/admin/signup.twig');
});


//////////// JOGANDO ////////////////////
$app->get('/', function ($req, $res, $args) {
    // Saber se o cara está logado

    // Se não estiver, mostrar login ou cadastro
    if (!isset($_SESSION["usuario"])) {
        return $res->withStatus(302)
            ->withHeader("Location", $_ENV["base_url"] . "entrar/");
    }
    // listar as trilhas
    $registros = Trilha::getAllOrOne();
    $conteudo = $this->view->fetch(
        'cliente/Home.twig',
        ["registros" => $registros]
    );
    return renderLayout($this, $res, $conteudo);
});

$app->get('/trilha/{id}/', function ($req, $res, $args) {
    $trilha = Trilha::getAllOrOne($args['id']);
    $fases = Fases::getByTrilha($args['id']);
    $conteudo = $this->view->fetch(
        'cliente/trilha.twig',
        [
            "trilha" => $trilha,
            "fases" => $fases,
            "base_url" => $_ENV['base_url']
        ]
    );
    return renderLayout($this, $res, $conteudo);
});

$app->get('/fase/{id}/', function ($req, $res, $args) {
    $registro = Fases::get($args['id']);
    var_dump($_POST);
    echo $this->view->fetch('cliente/fase.twig', ["registro" => $registro]);

});


///////////// ADMIN //////////////////////


$app->group('/admin', function () {

    $this->get('/sair/', function ($req, $res, $args) {
        $_SESSION["usuario"] = null;
        return $res->withStatus(302)
            ->withHeader("Location", $_ENV["base_url"] . "admin/");

    });

    // Home do Admin - Com a view de Login/Senha -
    // Sera preciso criar a validação dos dados
    $this->get('/', function ($req, $res, $args) {
        if (!empty($_POST['email']) && !empty($_POST['senha'])) {
            if ($_POST['email'] == 'usuario@desafio.com.br' && $_POST['senha'] == 'asdf') {
                $_SESSION["usuario"] = $_POST['email'];
            }
        }

        if (!isset($_SESSION["usuario"])) {
            require('view/admin/login.twig');
            die();
        }

        return renderLayout($this, $res);
    });

    // Post para login
    $this->post('/', function ($req, $res, $args) {
        return renderLayout($this, $res);
    });

// -------------<>--------------- //

    // Endpoint de teste (do twig)
    $this->get('/teste/', function ($req, $res, $args) {
        $conteudo = $this->view->fetch('admin/teste.twig', ["nome" => "Tiago Gouvea"]);
        return $this->view->render($res, 'admin/layout.twig', ["conteudo" => $conteudo]);
    });

// -------------<>--------------- //

    // Trilha
    $this->group('/trilha', function () {
        $this->get('/', function ($req, $res, $args) {
            $registros = Trilha::getAllOrOne();
            $conteudo = $this->view->fetch(
                'trilha/lista.twig',
                ["registros" => $registros]
            );
            return renderLayout($this, $res, $conteudo);
        });

        $this->get('/incluir', function ($req, $res, $args) {
            $conteudo = $this->view->fetch(
                'trilha/form.twig'
            );
            return $this->view->render($res, 'admin/layout.twig', ["conteudo" => $conteudo]);
        });
        $this->post('/incluir', function ($req, $res, $args) {
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
                ['registro' => $registro]
            );
            return $this->view->render($res, 'admin/layout.twig', ["conteudo" => $conteudo]);
        });
        $this->post('/editar/{id}', function ($req, $res, $args) {
            $ok = Trilha::salvar($args['id'], $_POST);
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

        // Fases - na trilha
        $this->get('/{id}/fases/', function ($req, $res, $args) {
            $trilha = Trilha::getAllOrOne($args['id']);
            $fases = Fases::getByTrilha($args['id']);
            $conteudo = fetch(
                $this,
                'trilha',
                'fases/lista.twig',
                ["registros" => $fases,
                    "trilha" => $trilha,
                    "id_trilha" => $args['id']
                ]
            );
            return renderLayout($this, $res, $conteudo);
        });

        // Fases - Incluir na trilha
        $this->get('/{id}/fase-incluir/', function ($req, $res, $args) {
            $trilha = Trilha::getAllOrOne($args['id']);
            $registros = Fases::getTrilhas();
            $conteudo = $this->view->fetch(
                'fases/form.twig',
                ["registros" => $registros,
                    "trilha" => $trilha,
                    "id_trilha" => $args['id']
                ]
            );
            return $this->view->render($res, 'admin/layout.twig', ["conteudo" => $conteudo, "base_url" => $_ENV['base_url']]);
        });

        // Fases - Incluir na trilha
        $this->post('/{id}/fase-incluir/', function ($req, $res, $args) {
            Fases::incluir($_POST);
            $urlRedirect = baseGroupUrl('trilha') . $args['id'] . '/fases/';
            return $res->withStatus(302)->withHeader("Location", $urlRedirect);
        });

    });

    // -------------<>--------------- //

    // Fases
    $this->group('/fase', function () {

        $this->get('/{id}/editar/', function ($req, $res, $args) {
            $registros = Fases::get($args['id']);
            $conteudo = $this->view->fetch(
                'fases/edit.twig', ["registros" => $registros]
            );
            return $this->view->render($res, 'admin/layout.twig', ["conteudo" => $conteudo]);
        });

        $this->post('/{id}/editar/', function ($req, $res, $args) {
            $status = Fases::edit($_POST, $args['id']);
            $result = Fases::getAll();
            $urlRedirect = baseGroupUrl('trilha') . $_POST['id_trilha'] . '/fases/';
            return $res->withStatus(302)->withHeader("Location", $urlRedirect);
        });

        $this->get('/{id}/excluir/', function ($req, $res, $args) {
            $idTrilha = Fases::get($args['id'])->id_trilha;
            var_dump($idTrilha);
            Fases::delete($args['id']);

            $urlRedirect = baseGroupUrl('trilha') . $idTrilha . '/fases/';
            return $res->withStatus(302)->withHeader("Location", $urlRedirect);
        });

        // Perguntas em Fases
        $this->get('/{id}/perguntas/', function ($req, $res, $args) {
            $fase = Fases::get($args['id']);
            $perguntas = Pergunta::getByFase($args['id']); // Ajustar > Fases::getByTrilha($args['id']);
            $conteudo = fetch(
                $this,
                'fase',
                'pergunta/list.twig',
                [
                    "registros" => $perguntas,
                    "fase" => $fase,
                    "id_fase" => $args['id']
                ]
            );
            return renderLayout($this, $res, $conteudo);
        });

        $this->get('/{id}/pergunta-incluir/', function ($req, $res, $args) {
            $fase = Fases::get($args['id']);
            $conteudo = fetch($this,
                'fase',
                'pergunta/add.twig',
                ["fase" => $fase,
                    "id_fase" => $args['id']
                ]
            );
            return $this->view->render($res, 'admin/layout.twig', ["conteudo" => $conteudo, "base_url" => $_ENV['base_url']]);
        });

        // Fases - Incluir na trilha
        $this->post('/{id}/fase-incluir/', function ($req, $res, $args) {
            Fases::incluir($_POST);
            $urlRedirect = baseGroupUrl('trilha') . $args['id'] . '/fases/';
            return $res->withStatus(302)->withHeader("Location", $urlRedirect);
        });

    });

    // -------------<>--------------- //

    // Perguntas
    $this->group('/pergunta', function () {

        $this->get('/{id}/editar', function ($req, $res, $args) {
            $result = Pergunta::getAllorOne($args['id']);
            $conteudo = $this->view->fetch('pergunta/edit.twig', ['result' => $result]);
            return $this->view->render($res, 'admin/layout.twig', ["conteudo" => $conteudo]);
        });

        $this->post('/{id}/editar', function ($req, $res, $args) {
            require "view/pergunta/edit.php";
            if (count($_POST)) {
                Pergunta::edit($args['id']);
                return $res->withStatus(302)
                    ->withHeader("Location", "/curso-php-2018/curso-php-2018/desafio/admin/pergunta/");
            }
        });

        $this->get('/{id}/excluir', function ($req, $res, $args) {
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
        $this->get('/{id}/opcao/', function ($req, $res, $args) {
            $pergunta = Pergunta::getAllOrOne($args['id']);
            $opcao = Opcao::getByPergunta($args['id']);
            $resultado = fetch(
                $this,
                'opcao',
                'opcao/list.twig',
                ["registros" => $opcao,
                    "pergunta" => $pergunta,
                    "id_pergunta" => $args['id']
                ]
            );
            return renderLayout($this, $res, $resultado);
        });

        $this->get('/{id}/opcao-incluir/', function ($req, $res, $args) {
            $opcao = Pergunta::getNomeFases();
            $registros = Opcao::listarPorId($args['id']);
            $conteudo = $this->view->fetch(
                'opcao/form.twig',
                ["registros" => $registros,
                    "opcao" => $opcao,
                    "id_pergunta" => $args['id']
                ]
            );
            return $this->view->render($res, 'admin/layout.twig', ["conteudo" => $conteudo, "base_url" => $_ENV['base_url']]);
        });

        // Fases - Incluir na trilha
        $this->post('/{id}/opcao-incluir/', function ($req, $res, $args) {
            Fases::incluir($_POST);
            $urlRedirect = baseGroupUrl('trilha') . $args['id'] . '/fases/';
            return $res->withStatus(302)->withHeader("Location", $urlRedirect);
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
        $this->get('/{id}/editar/', function ($req, $res, $args) {
            $resultado = Opcao::listarPorId($args['id']);
            $conteudo = $this->view->fetch('opcao/edit.twig', ['resultado' => $resultado]);
            return $this->view->render($res, 'admin/layout.twig', ["conteudo" => $conteudo]);

        });
        $this->post('/{id}/editar/', function ($req, $res, $args) {

            $ok = Opcao::editar($_POST, $args['id']);

            if ($ok)
                return $res->withStatus(302)->withHeader("Location", "/curso-php-2018/desafio/admin/opcao/");

            else
                echo "Erro ao incluir";
            var_dump($ok);
        });
        $this->get('/{id}/excluir/', function ($req, $res, $args) {
            //  echo "Excluir a fases " . $args['id'];
            $ok = Opcao::excluir($args['id']);
            if ($ok)
                return $res->withStatus(302)->withHeader("Location", baseGroupUrl("trilha"));

            else
                echo "Erro ao excluir";
            var_dump($ok);
        });
    });
});


/**
 * @param $app
 * @param $groupBaseUrl
 * @param $template
 * @param $data
 * @return mixed
 * Dá o fetch no twig adicionando algumas variáveis
 * base_url = base_url
 * base_admin_url = base_url ~ 'admin/'
 * base_group_url = base_url ~ 'admin/$groupBaseUrl/'
 */
function fetch($app, $groupBaseUrl, $template, $data)
{
    $baseAdminUrl = $_ENV['base_url'] . 'admin/';
    $baseGroupUrl = baseGroupUrl($groupBaseUrl);


    $data['base_url'] = $_ENV['base_url'];
    $data['base_admin_url'] = $baseAdminUrl;
    $data['base_group_url'] = $baseGroupUrl;
    return $app->view->fetch($template, $data);
}

function baseGroupUrl($group)
{
    return $_ENV['base_url'] . 'admin/' . $group . '/';
}

function renderLayout($app, $res, $conteudo = null)
{
    $baseAdminUrl = $_ENV['base_url'] . 'admin/';
    $usuario = $_SESSION['usuario'];
    return $app->view->render(
        $res,
        'admin/layout.twig',
        ["conteudo" => $conteudo, "base_admin_url" => $baseAdminUrl, 'usuario' => $usuario]
    );
}

$app->run();