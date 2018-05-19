<?php
require 'classes.php';

session_start();
echo "<pre>";
//var_dump($_SESSION['filmes']);

$films = $_SESSION['filmes'];
//var_dump($films[0]->title);

$filmsObject = [];

foreach ($films as $film) {
    $filmsObject = $film;
    var_dump($film);
    echo "<hr>";
}

// var_dump($filmsObject);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Star Wars</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <style type='text/css'>
            .box {
                
            }
            .title {
                
            }
            .logo {
                width: 200px;
            }
        </style>
    </head>
    <body>
        <div class='container-fluid box'>
            <div class='title'>
                <img src='./img/2000px-Star_Wars_Logo.svg.png' class='logo'/>
            </div>
            <div>
                <?php
                    echo "<h1>$hope</h1>";
                ?>
            </div>
        </div>
    </body>
</html>