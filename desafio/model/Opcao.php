<?php

class Opcao
{
    static function cadastrar($pergunta)
    {
        global $db;
        try {
// Salvar ele no banco de dados
            $sql = "insert into opcao (titulo,correta,ativa) values (:titulo,:correta,:ativa)";
            $std = $db->prepare($sql);
            $std->bindParam(":titulo", $pergunta['titulo'], PDO::PARAM_STR);
            $std->bindParam(":correta", $pergunta['correta'], PDO::PARAM_BOOL);
            $std->bindParam(":ativa", $pergunta['ativa'], PDO::PARAM_BOOL);
            $sucesso = $std->execute();
            return $sucesso;
        } catch (Exception $e) {
            var_dump($e);
//    die("Erro de conexão com o servidor!");
        }
    }

    static function listar()
    {
        global $db;
        try {
            $sql = "SELECT * FROM opcao ORDER BY ordem";
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
}
