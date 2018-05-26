<?php

require "Helper.php";

// Obter container do Slim
$container = $app->getContainer();

// Adicionar atributo "view" ao container.
// Será acessível via $this->view
$container['view'] = function ($container) {
    // Obter configurações do .env
    $templatePath = BASE_DIR.'/view/';
    $cachePath = false; //BASE_DIR.'/cache/';

    // A pasta de cache pode ser escrita?
    if ($cachePath !== false && !isWritablePath(realpath($cachePath))) {
        die("É preciso ter permissão de escrita na pasta " . realpath($cachePath));
    }

    // Iniciar twig
    $view = new \Slim\Views\Twig($templatePath, [
        'cache' => $cachePath
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new \Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};