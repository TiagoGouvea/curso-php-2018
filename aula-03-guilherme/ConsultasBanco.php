<?php

Class Consultas
{
    function Consultar()
    {
        try {
            global $db;
            $sql = 'SELECT p.id, p.id_fase, p.titulo, p.tipo, p.ativa
                FROM
                  pergunta AS p
                LEFT JOIN
                  opcao AS o ON o.id = p.id_fase';
            $std = $db->prepare($sql);
            $success = $std->execute();

            if ($success) {
                $result = $std->fetchAll(PDO::FETCH_OBJ);
            } else {
                echo "Erro na busca";
            }

        } catch (Exception $e) {
            var_dump($e);
        }
        return $result;
    }
}

$r = new Consultas();
$r->Consultar();
var_dump($r);
