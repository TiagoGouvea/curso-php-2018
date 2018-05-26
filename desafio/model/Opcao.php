<?php

class Opcao
{
    static function cadastrar($opcao)
    {
        global $db;
        try {
// Salvar ele no banco de dados
            $sql = "insert into opcao (titulo,correta,ativa) values (:titulo,:correta,:ativa)";
            $std = $db->prepare($sql);
            $std->bindParam(":titulo", $opcao['titulo'], PDO::PARAM_STR);
            $std->bindParam(":correta", $opcao['correta'], PDO::PARAM_BOOL);
            $std->bindParam(":ativa", $opcao['ativa'], PDO::PARAM_BOOL);
            $sucesso = $std->execute();
            return $sucesso;
        } catch (Exception $e) {
           // var_dump($e);
//    die("Erro de conexão com o servidor!");
        }
    }

    static function editar($opcao, $id){
        global $db;
        try {

// Salvar ele no banco de dados
 //           $s
            //ql = "UPDATE opcao SET (titulo,correta,ativa) values (:titulo,:correta,:ativa)where id = :id";
            $sql = "UPDATE opcao SET titulo = :titulo, correta = :correta, ativa = :ativa where id= :id";
            $std = $db->prepare($sql);
            $std->bindParam(":id", $id , PDO::PARAM_INT);
            $std->bindParam(":titulo", $opcao['titulo'], PDO::PARAM_STR);
            $std->bindParam(":correta", $opcao['correta'], PDO::PARAM_BOOL);
            $std->bindParam(":ativa", $opcao['ativa'], PDO::PARAM_BOOL);
            $sucesso = $std->execute();
            return $sucesso;

        } catch (Exception $e) {

   //die("Erro de conexão com o servidor!");
        }
    }
    static function listar()
    {
        global $db;
        try {
            $sql = "SELECT * FROM opcao ORDER BY id";
            $std = $db->prepare($sql);
            $successo = $std->execute();

            if ($successo) {
                $resultado = $std->fetchAll(PDO::FETCH_OBJ);
//                    var_dump($resultado);
            } else {
                $resultado = "<p>Erro na busca</p>";
            }
        } catch (Exception $e) {
            $resultado = "<p>Erro ao conectar com o servidor!</p>";
        }
        return $resultado;
    }

    static function listarPorId($id)
    {
        global $db;
        try {
            $sql = "SELECT * FROM opcao WHERE id= :id ";
            $std = $db->prepare($sql);
            $std->bindParam(":id", $id , PDO::PARAM_INT);
            $successo = $std->execute();

            if ($successo) {
                $resultados = $std->fetchAll(PDO::FETCH_OBJ);
                $resultado = $resultados[0];
            } else {
                $resultado = "<p>Erro na busca</p>";
            }
        } catch (Exception $e) {
            $resultado = "<p>Erro ao conectar com o servidor!</p>";
        }
        return $resultado;



    }


}
