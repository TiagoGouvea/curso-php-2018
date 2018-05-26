<?php
/*
 * Arquivo que carrega alguns recursos necessários por agora
 */

// Definir arquivo .env
$rootFolder = realpath(__DIR__ . '/../');
$envFile = $rootFolder . '/.env';
if (!file_exists($envFile)) {
    die("O arquivo .env não existe. Deveria existir em `" . $envFile . "` . Para mais informações leia o readme do projeto.");
}
$dotenv = new Dotenv\Dotenv($rootFolder);
$dotenv->load();
$dotenv->required("db_host", "db_post", "db_name", "db_user", "db_password");
$dsn = getenv("db_host");

// Definir pasta raiz do projeto
define("BASE_DIR", realpath(dirname(__FILE__)."/../"));

// Estamos em ambiente de desenvolvimento, ou produção?
$debug = getenv("env_debug") || false;
if ($debug) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
} else {
    die("Estamos em ambiente de produção?");
}

// Iniciar sessão
session_start();

// Carregar classes e arquivos necessários para accesso aos dados
require 'lib/Db.php';
require "model/Trilha.php";
require 'model/Fases.php';
//require 'model/Opcao.php';
//require 'model/Pergunta.php';
//require 'model/Trilha.php';

?>