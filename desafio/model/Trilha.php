<?php

global $db;

class Trilha
{

    public $titulo;
    public $descricao;
    public $ordem;
    public $ativa;

    static function getAllOrOne($id = null)
    {
        global $db;
        if (isset($id)) {
            try {
                $sql = 'SELECT * FROM trilha
                  WHERE id = :id';
                $std = $db->prepare($sql);
                $std->bindParam(":id", $id, PDO::PARAM_INT);
                $success = $std->execute();
                $registros = $std->fetchAll(PDO::FETCH_OBJ);
                return $registros[0];

            } catch (Exception $e) {
                var_dump($e);
            }
        } else {
            try {
                $sql = 'SELECT * FROM trilha';
                $std = $db->prepare($sql);
                $success = $std->execute();
                return $std->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                var_dump($e);
            }
        }
    }

    static function cadastro($registro)
    {
        global $db;
        try {
            $sql = "
                INSERT INTO trilha (
                    titulo, 
                    descricao, 
                    ativa
                ) 
                VALUES (
                    :titulo, 
                    :descricao, 
                    :ativa
                )
                ";

            $std = $db->prepare($sql);
            $std->bindParam(":titulo", $registro['titulo'], PDO::PARAM_STR);
            $std->bindParam(":descricao", $registro['descricao'], PDO::PARAM_STR);
            $std->bindParam(":ativa", $registro['ativa'], PDO::PARAM_BOOL);
            $success = $std->execute();
            if ($success)
                return ($success);
            else {
                var_dump($std->errorInfo());
                die("Falha ao incluir o registro");
            }

        } catch (Exception $e) {
            die("Erro ao de comunicação com o servidor");
        }
    }

    public static function salvar($id, $registro)
    {
        global $db;
        try {
            $sql = "
                update trilha 
                set titulo=:titulo,
                descricao=:descricao,
                ativa=:ativa
                where id=:id";
            $std = $db->prepare($sql);
            $std->bindParam(":titulo", $registro['titulo'], PDO::PARAM_STR);
            $std->bindParam(":descricao", $registro['descricao'], PDO::PARAM_STR);
            $std->bindParam(":ativa", $registro['ativa'], PDO::PARAM_BOOL);
            $std->bindParam(":id", $id, PDO::PARAM_INT);
            $success = $std->execute();
            if ($success)
                return ($success);
            else {
                var_dump($std->errorInfo());
                die("Falha ao alterar o registro");
            }

        } catch (Exception $e) {
            die("Erro ao de comunicação com o servidor");
        }

    }

    public static function excluir($id)
    {
        global $db;
        try {
            $sql = "
                delete from trilha where id=:id";
            $std = $db->prepare($sql);
            $std->bindParam(":id", $id, PDO::PARAM_INT);
            $success = $std->execute();
            if ($success)
                return ($success);
            else {
                var_dump($std->errorInfo());
                die("Falha ao excluir o registro");
            }

        } catch (Exception $e) {
            die("Erro ao de comunicação com o servidor");
        }
    }
}