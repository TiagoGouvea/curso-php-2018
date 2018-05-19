<?php

global $db;
class Pergunta{

    public $id;
    public $titulo;
    public $tipo;
    public $ativa;

    static function cadastro($post){
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

}