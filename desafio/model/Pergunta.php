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

            $sql = "insert into pergunta (tituloPergunta, id_fase, tipo, ativa) values (:var1, :var2, :var3, :var4)";
            $std = $db->prepare($sql);
            $std->bindParam(":var1", $post['tituloPergunta'], PDO::PARAM_STR);
            $std->bindParam(":var2", $post['id_fase'], PDO::PARAM_INT);
            $std->bindParam(":var3", $post['tipo'], PDO::PARAM_STR);
            $std->bindParam(":var4", $post['ativo'], PDO::PARAM_BOOL);
            $sucess = $std->execute();

            return $sucess;

        } catch (Exception $e) {
            die("Erro ao Cadastrar");
        }
    }

    static function getAllorOne($var){
        global $db;
        if(isset($var)){
            try {
                $sql = 'SELECT p.id, p.id_fase, f.titulo, p.tituloPergunta, p.tipo, p.ativa
                FROM
                  pergunta AS p
                LEFT JOIN
                  fase AS f ON f.id = p.id_fase
                  WHERE p.id = :var1';
                $std = $db->prepare($sql);
                $std->bindParam(":var1", $var, PDO::PARAM_INT);
                $success = $std->execute();

                return $result = $std->fetchAll(PDO::FETCH_OBJ);

            } catch (Exception $e) {
                var_dump($e);
            }
        } else {

            try {
                $sql = 'SELECT p.id, p.id_fase, f.titulo ,p.tituloPergunta, p.tipo, p.ativa
                    FROM
                      pergunta AS p
                    LEFT JOIN
                      fase AS f ON f.id = p.id_fase';
                $std = $db->prepare($sql);
                $success = $std->execute();

                return $result = $std->fetchAll(PDO::FETCH_OBJ);

            } catch (Exception $e) {
                var_dump($e);
            }
        }
    }

    static function getNomeFases(){
        global $db;
        try {
            $sql = 'SELECT distinct p.id_fase, f.titulo
                FROM
                  pergunta AS p
                LEFT JOIN
                  fase AS f ON f.id = p.id_fase';
            $std = $db->prepare($sql);
            $success = $std->execute();

            return $result = $std->fetchAll(PDO::FETCH_OBJ);

        } catch (Exception $e) {
            var_dump($e);
        }
    }

    static function edit($id){
        global $db;
        $titulo = $_POST['tituloPergunta'];
        $id_fase = $_POST['id_fase'];
        $tipo = $_POST['tipo'];
        if (($_POST['ativo']) === "on") { $ativo = 1; } else { $ativo = 0; }

        try {
            $sql = "UPDATE pergunta 
                      SET tituloPergunta = '$titulo', `id_fase` = '$id_fase', tipo = '$tipo', ativa = '$ativo'
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

            $sql = "DELETE FROM `pergunta` WHERE `id` = :var1";
            $std = $db->prepare($sql);
            $std->bindParam(":var1", $id, PDO::PARAM_INT);
            $success = $std->execute();

            return $success;

        } catch (Exception $e) {
            return $e;
        }
    }

    public static function getByFase($idFase)
    {
        global $db;
        try {
            $sql = 'SELECT * FROM pergunta where id_fase=:id_fase';
            $std = $db->prepare($sql);
            $std->bindParam(":id_fase", $idFase, PDO::PARAM_INT);
            $success = $std->execute();
            return $std->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            var_dump($e);
        }
    }

}