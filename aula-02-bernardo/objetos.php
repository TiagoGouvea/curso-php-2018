<?php
class Planet{
    public $name;
    public $gravidade;
    public $population;

    function digaPopulacao(){
        echo "Oi";
    }
}
$terra = new Planet();
$terra->name = "Terra";
$terra->gravidade = 9.8;
$terra->population = 7000000000;



$terra->digaPopulacao()."<br";


var_dump($terra);
