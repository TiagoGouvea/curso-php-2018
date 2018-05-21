<?php

global $db;
class Pergunta{

    public $id;
    public $titulo;
    public $tipo;
    public $ativa;

    static function add($post){
        global $db;
        try {

            $sql = "insert into pergunta (titulo, tipo, ativa) values (:var1, :var2, :var3)";
            $std = $db->prepare($sql);
            $std->bindParam(":var1", $post['titulo'], PDO::PARAM_STR);
            $std->bindParam(":var2", $post['tipo'], PDO::PARAM_STR);
            $std->bindParam(":var3", $post['ativo'], PDO::PARAM_BOOL);
            $sucesso = $std->execute();

            return $sucesso;

        } catch (Exception $e) {
            die("Erro ao Cadastrar");
        }
    }

    static function getAll(){
        global $db;
        try {
            $sql = 'SELECT p.id, p.id_fase, p.titulo, p.tipo, p.ativa
                FROM
                  pergunta AS p
                LEFT JOIN
                  opcao AS o ON o.id = p.id_fase';
            $std = $db->prepare($sql);
            $success = $std->execute();

            return $result = $std->fetchAll(PDO::FETCH_OBJ);

        } catch (Exception $e) {
            var_dump($e);
        }
    }

    static function getOne($id){
        global $db;
        try {
            $sql = 'SELECT p.id, p.id_fase, p.titulo, p.tipo, p.ativa
                FROM
                  pergunta AS p
                LEFT JOIN
                  opcao AS o ON o.id = p.id_fase
                  WHERE p.id = :var1';
            $std = $db->prepare($sql);
            $std->bindParam(":var1", $id, PDO::PARAM_INT);
            $success = $std->execute();

            return $result = $std->fetchAll(PDO::FETCH_OBJ);

        } catch (Exception $e) {
            var_dump($e);
        }
    }

    static function edit($id){
        global $db;
        $titulo = $_POST['titulo'];
        $id_fase = $_POST['id_fase'];
        $tipo = $_POST['tipo'];
        if (($_POST['ativo']) === "on") { $ativo = 1; } else { $ativo = 0; }

        try {
            $sql = "UPDATE pergunta SET titulo = '$titulo', tipo = '$tipo', ativa = '$ativo'
    WHERE pergunta.id = {$id}";
            $std = $db->prepare($sql);

            return $success = $std->execute();

        } catch (Exception $e) {
            $erro = "Erro ao atualizar os registro";
        }

    }

    static function delete($id){
        global $db;
        try {
            // Salvar ele no banco de dados

            $sql = "DELETE FROM `perguntsa` WHERE `ida` = :var1";
            $std = $db->prepare($sql);
            $std->bindParam(":var1", $id, PDO::PARAM_INT);
            $success = $std->execute();

            return $success;

        } catch (Exception $e) {
            return $e;
        }
    }

}