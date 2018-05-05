<?php

    class Planet{
        public $name;
        public $gravity;
        public $popularion;


        function digaPopulacao(){
            echo "Tenho ".$this->popularion." habitantes";
        }
    }

    $terra = new Planet();
    $terra->name = "Terra";
    $terra->gravity = 9.8;
    $terra->popularion = 70000000;

    $terra->digaPopulacao();

    var_dump($terra);
