<?php 
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
        curl_setopt($curl, CURLOPT_USERPWD, "username:password");
    
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
        $result = curl_exec($curl);
    
        curl_close($curl);
    
        return $result;
    }
    
    $data = CallAPI("get",
        "https://good-burger-prod.herokuapp.com/api/hamburger/");

    
    $burgers = json_decode($data);

    //$hamburger = $burgers[0];

    function viewBurgers($hamburger) {
        
        $fotos = $hamburger->place->photos[0]->photo_reference;
        $urlFinal = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=300&key=AIzaSyBEK74-zUzXuVWkdzoNG5rV_wL2uOSneXc&photoreference=";
        $urlFinal = $urlFinal . $fotos;
    
        $weekAverage = ajustValue($hamburger, 'weekAverage');
        $service = ajustValue($hamburger, 'service');
        $ambiance = ajustValue($hamburger, 'ambiance');
        $meat = ajustValue($hamburger, 'meat');
        $price = ajustValue($hamburger, 'price');
        $taste = ajustValue($hamburger, 'taste');
        
        $photos = $hamburger->place->photos;
        $availables = $hamburger->place->reviews;

        echo "
            <div class='container'>
                <div class='row align-items-start'>
                    <div class='col-sm-3 col-md-3'>
                        <div class='box content'>
                            <div class='photo'>
                                <img class='imgProfile' src=$urlFinal style='width: 100px';> <br>
                            </div>
                            <span class='nameHamburger'>
                                <h4>{$hamburger->place->name}</h4>
                                {$hamburger->place->vicinity}
                            </span>
                        </div>
                        <div class='box content'>
                            Average: $weekAverage <br />
                            Taste: $taste <br />
                            Service: $service <br />
                            Ambience: $ambiance <br />
                            Meat: $meat <br />
                            Price: $price <br />
                        </div>
                    </div>
                    <div class='col-sm-8 col-md-8'>
                        <div class='box content'>
            ";
            foreach ($photos as $photo) {
                viewPhotos($photo);
            }
            echo "
                            </div>
                            <div class='box content'>
            ";
            foreach ($availables as $available) {
                viewAvailable($available);
            }
            echo "
                            </div>
                        </div>
                    </div>
                </div>
        ";

    } 

    function ajustValue ($obj, $field) {
        if (isset($obj->$field))
            return round($obj->$field);
        return 0;
    }

    function viewPhotos($photo) {
        $urlFinal = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=300&key=AIzaSyBEK74-zUzXuVWkdzoNG5rV_wL2uOSneXc&photoreference=";
        $urlFinal = $urlFinal . $photo->photo_reference;
        ////var_dump($urlFinal);
        echo "<img src=$urlFinal style='width: 100px; height: 100px;'>";
    }

    function viewAvailable($available) {
        echo "
            <img src=$available->profile_photo_url style='width:30px'/>
            $available->author_name <br />
            <span class='available'>$available->text</span> <br />
            <hr>

        ";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='URF-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Hamburgers</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <style type='text/css'>
            .box {
                border-width: 1px;
                border-style: ridge;
                border-radius: 2px; 
                background-color: #FFF;
                margin: 5px;
            }
            .content {
                padding: 5px 10px 20px 20px;
                margin: 5px 10px 10px 5px;
            }
            .nameHamburger {
                font-size: 12;
                text-align: center;
            }
            .imgProfile { 
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 50%;
                border-radius: 50%;
            }
            .main {
                background-color: #FBEFEF;
                
            }
            .header {
                background-color: rgb(182,31,35);
                padding-bottom: 30px; 
            }
            .title {
                font-size: 60px;
                text-align: center;
                color: #FFF;
                padding-top: 20px;
            }
            .available {
                font-style: italic;
                text-align: center;
                margin-top: 5px;
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
            <div class='header'>
                <h4 class='title'>Hamburgers</h4>
            </div>
            <div class="main">
                
            <?php
                foreach ($burgers as $hamburger) {
                    viewBurgers($hamburger);
                    echo "<hr>";
                }
            ?>
        </div>
    </body>
</html>