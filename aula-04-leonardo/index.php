<?php
/**
 * Created by PhpStorm.
 * User: leonardo
 * Date: 19/05/18
 * Time: 14:04
 */
//    phpinfo();
    session_start();
    require 'vendor/autoload.php';
    require 'nomes.php';

//    $faker = Faker\Factory::create();
//    echo "<pre>";
//    echo "Olá " . $faker->name;
//    var_dump($faker);

    $app = new Slim\App;

//    Declarando minhas rotas
    $app->get('/ola/{name}', function ($req, $res, $arg) {
        echo "Olá! " . $arg['name'];
    });

    $app->get('/incluir', function ($req, $res, $arg) {
        require 'form.html';
    });

    $app->post('/incluir', function ($req, $res, $arg) {
//        var_dump($_POST);
//        $_SESSION['nomes'][]=$_POST['nome'];
//        if (isset($_SESSION['posts']))
//            $_SESSION['posts'] = 0;
//        $_SESSION['posts']++;
//        var_dump($_SESSION);
        Nome::incluir($_POST['nome']);
    });

    $app->get('/listar', function($req, $res, $arg) {

//        $registros = $_SESSION['nomes'];
//        var_dump($registros);
        $registros = Nome::getAll();
        require 'list.php';
    });

    $app->run();
?>
