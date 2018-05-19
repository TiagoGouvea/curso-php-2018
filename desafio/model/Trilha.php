<?php

global $db;
class Trilha{

    public $titulo;
    public $descricao;
    public $ordem;
    public $ativa;

    static function cadastrar($post){
        global $db;
        try {
            $sql = "
                INSERT INTO trilha (
                    titulo, 
                    descricao, 
                    ordem, 
                    ativa
                ) 
                VALUES (
                    :title, 
                    :description, 
                    :numTrilha, 
                    :status
                )
                ";

            $std = $db->prepare($sql);
            $std->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
            $std->bindParam(":description", $_POST['description'], PDO::PARAM_STR);
            $std->bindParam(":numTrilha", $_POST['numTrilha'], PDO::PARAM_INT);
            $std->bindParam(":status", $_POST['status'], PDO::PARAM_BOOL);
            $success = $std->execute();
            if ($success)
                echo "<p>Registro incluído</p>";
            else
                echo "<p>Falha ao incluir o registro</p>";
        } catch (Exception $e) {
            echo "<p>Erro ao de comunicação com o servidor</p>";
        }
    }
}