<?php

class Personagem{
    public $PersonagemNome;
    public $cabelo;

    /**
     * Personagem constructor.
     * @param $name
     * @param $cabelo
     */
//    public function __construct($name, $cabelo){
//        $this->PersonagemNome = $name;
//        $this->cabelo = $cabelo;
//    }

    /**
     * @return mixed
     */
    public function getPersonagemNome(){
        return $this->PersonagemNome[0];
    }

    /**
     * @param mixed $PersonagemNome
     */
    public function setPersonagemNome($PersonagemNome){
        $this->PersonagemNome = $PersonagemNome;
    }

    /**
     * @return mixed
     */
    public function getCabelo(){
        return $this->cabelo[1];
    }

    /**
     * @param mixed $cabelo
     */
    public function setCabelo($cabelo){
        $this->cabelo = $cabelo;
    }

    public function __toString(){
        return "<br>" . $this->getCabelo();
    }

}

function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();
    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    //curl_setopt($curl, CURLOPT_USERPWD, "username:password");
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

$data = CallAPI("get","https://swapi.co/api/people/");
$data = json_decode($data);

$name_1 = $data->results[0]->name;
$hair_1 = $data->results[0]->hair_color;

$teste1 = new Personagem();
$teste1->setCabelo($hair_1);
$teste1->setPersonagemNome($name_1);

$teste1->getCabelo();

var_dump($teste1);


