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
            $std->bindParam(":title", $post['title'], PDO::PARAM_STR);
            $std->bindParam(":description", $post['description'], PDO::PARAM_STR);
            $std->bindParam(":numTrilha", $post['numTrilha'], PDO::PARAM_INT);
            $std->bindParam(":status", $post['status'], PDO::PARAM_BOOL);
            $success = $std->execute();
            if ($success)
                return ($success);
            else
                die("Falha ao incluir o registro");
        } catch (Exception $e) {
            die("Erro ao de comunicação com o servidor");
        }
    }
}