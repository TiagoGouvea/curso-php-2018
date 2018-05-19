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
            if ($sucesso) {
                echo "Registro incluído!";
            } else {
                $erro = "Erro ao inserir registro";
                //var_dump($std->errorInfo());
            }
        } catch (Exception $e) {
            $erro = "Erro ao inserir registro";
//            var_dump($e);
            //    die("Erro de conexão com o servidor!");
        }
    }

}