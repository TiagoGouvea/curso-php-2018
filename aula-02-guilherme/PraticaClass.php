<html>
    <title>Pagina</title>
        <body>
            <h1>Personagens</h1>

        </body>
</html>




<?php

class Personagem{
    public $name;
    public $cabelo;

    /**
     * Personagem constructor.
     * @param $item
     */
    public function __construct($item){
        $this->name = $item->name;
        $this->cabelo = $item->hair_color;
    }

    /**
     * @return mixed
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name){
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCabelo(){
        return $this->cabelo;
    }

    /**
     * @param mixed $cabelo
     */
    public function setCabelo($cabelo){
        $this->cabelo = $cabelo;
    }

//    public function CallAPI($method, $url, $data = false)
//    {
//        $curl = curl_init();
//        switch ($method)
//        {
//            case "POST":
//                curl_setopt($curl, CURLOPT_POST, 1);
//
//                if ($data)
//                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
//                break;
//            case "PUT":
//                curl_setopt($curl, CURLOPT_PUT, 1);
//                break;
//            default:
//                if ($data)
//                    $url = sprintf("%s?%s", $url, http_build_query($data));
//        }
//        // Optional Authentication:
//        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//        //curl_setopt($curl, CURLOPT_USERPWD, "username:password");
//        curl_setopt($curl, CURLOPT_URL, $url);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//        $result = curl_exec($curl);
//        curl_close($curl);
//        return $result;
//    }

}

class Personagens{
    static public $personagens = [];

    static public function readApi(){
        $data = self::CallAPI("get","https://swapi.co/api/people/");
        $data = json_decode($data);

         foreach ($data as $item){
             $data = new Personagem($item);
             self::$personagens[]=$data;
        }
        return self::$personagens;
    }
    static function CallAPI($method, $url, $data = false)
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
}


//$teste1 = new Personagem(Personagens::readApi());
//var_dump($teste1);

//
//echo $teste1->getName();
//echo $teste1->getCabelo();
//
//echo "<br>";
//$teste2 = new Personagem(1, 1);
//echo $teste2->getName();
//echo $teste2->getCabelo();

//echo $teste1->getAll();

