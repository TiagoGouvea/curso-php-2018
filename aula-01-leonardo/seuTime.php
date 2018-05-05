<html>
    <head>
        <meta charset='UTF-8'>
        <title>Qual o seu time</title>
    </head>
    <body>
        <?php
            if (count($_POST) > 0) {
                
                var_dump($_POST);

                $times = array(
                    "AME" => "América Mineiro",
                    "CAM" => "Atlético Mineiro",
                    "CAP" => "Atlético Paranaense",
                    "BAH" => "Bahia",
                    "BOT" => "Botafogo",
                    "CEA" => "Ceará",
                    "CHA" => "Chapecoense",
                    "COR" => "Corinthians",
                    "CRU" => "Cruzeiro",
                    "FLA" => "Flamengo",
                    "FLU" => "Fluminense",
                    "GRE" => "Grêmio",
                    "INT" => "Internacional",
                    "PAL" => "Palmeiras",
                    "PAR" => "Paraná",
                    "SAN" => "Santos",
                    "SAO" => "São Paulo",
                    "SPO" => "Sport",
                    "VAS" => "Vasco da Gama",
                    "VIT" => "Vitória"
                );

                $brasileiro = array(
                    "AME" => "",
                    "CAM" => "1971",
                    "CAP" => "2001",
                    "BAH" => "1959 e 1988",
                    "BOT" => "1968 e 1995",
                    "CEA" => "",
                    "CHA" => "",
                    "COR" => "1990, 1998, 1999, 2005, 2011, 2015 e 2017",
                    "CRU" => "1966, 2003, 2013 e 2014",
                    "FLA" => "1980, 1982, 1983, 1987, 1992 e 2009",
                    "FLU" => "1970, 1984, 2010 e 2012",
                    "GRE" => "1981 e 1996",
                    "INT" => "1979",
                    "PAL" => "1960, 1967, 1967, 1969, 1972, 1973, 1993, 1994 e 2016",
                    "PAR" => "",
                    "SAN" => "1961, 1962, 1963, 1964, 1965, 1968, 2002 e 2004",
                    "SAO" => "1977, 1986, 1991, 2006, 2007 e 2008",
                    "SPO" => "1987",
                    "VAS" => "1974, 1989, 1997 e 2000",
                    "VIT" => ""
                );

                $copadobrasil = array(
                    "AME" => "",
                    "CAM" => "2014",
                    "CAP" => "",
                    "BAH" => "",
                    "BOT" => "",
                    "CEA" => "",
                    "CHA" => "",
                    "COR" => "1995, 2002 e 2009",
                    "CRU" => "1993, 1996, 2000, 2003 e 2017",
                    "FLA" => "1990, 2006 e 2013",
                    "FLU" => "2007",
                    "GRE" => "1989, 1994, 1997, 2001 e 2016",
                    "INT" => "1992",
                    "PAL" => "1998, 2012 e 2015",
                    "PAR" => "",
                    "SAN" => "2010",
                    "SAO" => "",
                    "SPO" => "2008",
                    "VAS" => "2011",
                    "VIT" => ""
                );

                $libertadores = array(
                    "AME" => "",
                    "CAM" => "2013",
                    "CAP" => "",
                    "BAH" => "",
                    "BOT" => "",
                    "CEA" => "",
                    "CHA" => "",
                    "COR" => "2012",
                    "CRU" => "1976 e 1997",
                    "FLA" => "1981",
                    "FLU" => "",
                    "GRE" => "1983, 1995 e 2017",
                    "INT" => "2006 e 2010",
                    "PAL" => "1999",
                    "PAR" => "",
                    "SAN" => "1962, 1963 e 2011",
                    "SAO" => "1993, 1994 e 2005",
                    "SPO" => "",
                    "VAS" => "1998",
                    "VIT" => ""
                );

                $mundial = array(
                    "AME" => "",
                    "CAM" => "",
                    "CAP" => "",
                    "BAH" => "",
                    "BOT" => "",
                    "CEA" => "",
                    "CHA" => "",
                    "COR" => "2000 e 2012",
                    "CRU" => "",
                    "FLA" => "1981",
                    "FLU" => "",
                    "GRE" => "1983",
                    "INT" => "2006",
                    "PAL" => "",
                    "PAR" => "",
                    "SAN" => "1962, 1963",
                    "SAO" => "1993, 1994 e 2005",
                    "SPO" => "",
                    "VAS" => "",
                    "VIT" => ""
                );

                $rebaixamentos = array(
                    "AME" => "1993, 1998, 2001, 2011 e 2016",
                    "CAM" => "2005",
                    "CAP" => "1989, 1993 e 2011",
                    "BAH" => "1997, 2003 e 2014",
                    "BOT" => "2002 e 2014",
                    "CEA" => "1993 e 2011",
                    "CHA" => "",
                    "COR" => "2007",
                    "CRU" => "",
                    "FLA" => "",
                    "FLU" => "1996 e 1997",
                    "GRE" => "1991 e 2004",
                    "INT" => "2016",
                    "PAL" => "2002 e 2012",
                    "PAR" => "1999 e 2007",
                    "SAN" => "",
                    "SAO" => "",
                    "SPO" => "1992, 1994, 2009 e 2012",
                    "VAS" => "2008, 2013 e 2015",
                    "VIT" => "1982, 1991, 2004, 2010 e 2014"
                );
                
                $siglaTime = $_POST['time'];
                $nomeTime = $times[$siglaTime];
                
                echo "<hr>";
                echo "Olá " . $_POST['nome'] . " você torce para o $nomeTime";

                if ($brasileiro[$siglaTime] != 0 )
                {
                    echo "<hr>";
                    echo "Seu time foi campeão brasileiro nesse(s) ano(s) " . $brasileiro[$siglaTime];
                }

                if ($rebaixamentos[$siglaTime] != 0 )
                {
                    echo "<hr>";
                    echo "Seu time foi rebaixado nesse(s) ano(s) " . $rebaixamentos[$siglaTime];
                }

                if ($copadobrasil[$siglaTime] != 0 )
                {
                    echo "<hr>";
                    echo "Seu time foi campeão da Copa do Brasil nesse(s) ano(s) " . $copadobrasil[$siglaTime];
                }

                if ($libertadores[$siglaTime] != 0 )
                {
                    echo "<hr>";
                    echo "Seu time foi campeão da Libertadores nesse(s) ano(s) " . $libertadores[$siglaTime];
                }
                
                if ($mundial[$siglaTime] != 0 )
                {
                    echo "<hr>";
                    echo "Seu time foi campeão Mundial nesse(s) ano(s) " . $mundial[$siglaTime];
                }

            } else {
        ?>
        <h1>Qual é o seu time?</h1>
        <form method='post'>
                Nome:<input type='text' name='nome'/>
                Time:<select name='time'>
                        <option value='AME'>América Mineiro</option>
                        <option value='CAM'>Atlético Mineiro</option>
                        <option value='CAP'>Atlético Paranaense</option>
                        <option value='BAH'>Bahia</option>
                        <option value='BOT'>Botafogo</option>
                        <option value='CEA'>Ceará</option>
                        <option value='CHA'>Chapecoense</option>
                        <option value='COR'>Corinthians</option>
                        <option value='CRU'>Cruzeiro</option>
                        <option value='FLA'>Flamengo</option>
                        <option value='FLU'>Fluminense</option>
                        <option value='GRE'>Grêmio</option>
                        <option value='INT'>Internacional</option>
                        <option value='PAL'>Palmeiras</option>
                        <option value='PAR'>Paraná</option>
                        <option value='SAN'>Santos</option>
                        <option value='SAO'>São Paulo</option>
                        <option value='SPO'>Sport</option>
                        <option value='VAS'>Vasco da Gama</option>
                        <option value='VIT'>Vitória</option>
                    </select>
                <input type='submit' value='enviar'/>
        </form>
        <?php
            }
        ?>
    </body>
</Html>