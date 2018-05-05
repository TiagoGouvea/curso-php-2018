<?php
/*
 * Classes!
 * - Planeta
 * - Pessoa
 */

class Planet
{
    public $name;
    public $gravity;
    public $population;
    public $surface_water;
    public $residents=[];

    function __construct($name)
    {
        $this->name=$name;
    }

    function digaPopulacao(){
        if (isset($this->population))
            echo "Eu tenho ".$this->population." habitantes";
        else
            echo "Eu tenho não tenho habitantes";
    }

    public function addHabitant($person)
    {
        $this->residents[]=$person;
        $this->population++;
    }
}

class Person{
    public $name;
    /* @var $planet Planet */
    public $planet;

    function __construct($name)
    {
        $this->name=$name;
    }

    public function digaOndeMora()
    {
        echo "Moro no planeta ".$this->planet->name;
    }

    public function setPlanet($planet)
    {
        $this->planet=$planet;
//        $planet->addHabitant($this);
        $this->planet->addHabitant($this);
    }
}

echo "<h1>Planetas</h1>";

// Terra
$planeta1 = new Planet("Terra");
$planeta1->gravity = 9.8;
$planeta1->population = 7000000000;

// Mercurio
$mercurio = new Planet("Mercurio");
$mercurio->surface_water = 10;

// Planetas
$planetas = [$planeta1,$mercurio];

// Exibir planetas
foreach ($planetas as $planeta){
    echo "<h2>$planeta->name</h2><br>";
    echo $planeta->digaPopulacao();
}

echo "<hr><h1>Pessoas</h1>";

// Tiago
$tiago = new Person("Tiago");

$tiago->setPlanet($planeta1);
//$tiago->planet = $terra;

//$terra->name = "Mundo";
//echo "De fato o ".$tiago->name." mora em ".$tiago->planet->name."<br>";
//var_dump($tiago);

$pessoas = array($tiago);

// Exibir pessoas
foreach ($pessoas as $umaPessoa){
    echo "<h2>$umaPessoa->name</h2><br>";
    echo $tiago->digaOndeMora()."<br>";
    echo $tiago->planet->digaPopulacao();
}

echo "<hr>";

/* @var $ultimoHabitante Person */
$ultimoHabitante = $planeta1->residents[count($planeta1->residents)-1];
echo "Ultimo habitante da ".$planeta1->name." é o ".$ultimoHabitante->name;

// lowerCamelCase - $tiago = new Person();
// UpperCamelCase - Class