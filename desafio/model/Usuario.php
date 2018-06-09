<?php
/**
 * Created by PhpStorm.
 * User: Geronimo
 * Date: 09/06/2018
 * Time: 13:02
 */
global $db;

class Usuario
{

    public $nome;
    public $idade;
    public $email;
    public $senha;

    static function getAllOrOne($id = null)
    {
        global $db;
        if (isset($id)) {
            try {
                $sql = 'SELECT * FROM usuario
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
                $sql = 'SELECT * FROM usuario';
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
                INSERT INTO usuario (
                    nome, 
                    idade,
                    email, 
                    senha                    
                ) 
                VALUES (
                    :nome, 
                    :idade, 
                    :email,
                    :senha
                )
                ";

            $std = $db->prepare($sql);
            $std->bindParam(":nome", $registro['nome'], PDO::PARAM_STR);
            $std->bindParam(":idade", $registro['idade'], PDO::PARAM_INT);
            $std->bindParam(":email", $registro['email'], PDO::PARAM_STR);
            $std->bindParam(":senha", $registro['senha'], PDO::PARAM_STR);
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
                update usuario 
                set nome=:nome,
                idade=:idade,
                email=:email,
                senha=:senha
                where id=:id";
            $std = $db->prepare($sql);
            $std->bindParam(":nome", $registro['nome'], PDO::PARAM_STR);
            $std->bindParam(":idade", $registro['idade'], PDO::PARAM_INT);
            $std->bindParam(":email", $registro['email'], PDO::PARAM_STR);
            $std->bindParam(":senha", $registro['senha'], PDO::PARAM_STR);
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
                delete from usuario where id=:id";
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