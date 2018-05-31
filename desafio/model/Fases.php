<?php

    global $db;
/**
 * Created by PhpStorm.
 * User: leonardo
 * Date: 19/05/18
 * Time: 17:07
 */
    class Fases {

        public $id;
        public $title;
        public $description;
        public $order;
        public $status;

        public static function getAll() {
            global $db;

            try {
                $sql = "SELECT * FROM fase ORDER BY ordem";
                $std = $db->prepare($sql);
                $success = $std->execute();

                if ($success) {
                    $result = $std->fetchAll(PDO::FETCH_OBJ);
                } else {
                    $result = "<p>Erro na busca</p>";
                }
            } catch (Exception $e) {
                $result = "<p>Erro ao conectar com o servidor!</p>";
            }
            return $result;
        }

        public static function getByTrilha($idTrilha)
        {
            global $db;
            try {
                $sql = 'SELECT * FROM fase where id_trilha=:id_trilha';
                $std = $db->prepare($sql);
                $std->bindParam(":id_trilha", $idTrilha, PDO::PARAM_INT);
                $success = $std->execute();
                return $std->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                var_dump($e);
            }
        }

        public static function getTrilhas() {
            global $db;
            try {
                $sql = 'SELECT id AS id_trilha, titulo AS titulo_trilha
                        FROM trilha';
                $std = $db->prepare($sql);
                $success = $std->execute();
                if ($success)
                    $result = $std->fetchAll(PDO::FETCH_OBJ);
                else
                    $result = "<p>Nenhum item encontrado!</p>";
            } catch (Exception $e) {
                var_dump($e);
            }
            return $result;
        }

        public static function incluir($post) {
            global $db;
            try {

                $sql = "INSERT INTO fase (titulo, conteudo, ordem, ativa, id_trilha) VALUES (:title, :description, :order, :status, :trilha)";

                $std = $db->prepare($sql);
                $std->bindParam(":title", $post['titulo'], PDO::PARAM_STR);
                $std->bindParam(":description", $post['descricao'], PDO::PARAM_STR);
                $std->bindParam(":order", $post['order'], PDO::PARAM_INT);
                $std->bindParam(":status", $post['ativa'], PDO::PARAM_BOOL);
                $std->bindParam(":trilha",$post['trilha'], PDO::PARAM_INT);

                return $std->execute();

            } catch (Exception $e) {
                echo "Erro ao incluir o registro";
            }
        }

        public static function add($id) {
            global $db;
            try {
                $sql = 'SELECT fase.id AS id, fase.titulo AS titulo, 
                    fase.conteudo AS descricao, fase.ordem AS ordem, 
                    fase.ativa AS ativa, trilha.id AS id_trilha, trilha.titulo AS titulo_trilha
                    FROM fase
                    INNER JOIN trilha
                    ON trilha.id = fase.id_trilha WHERE fase.id='. $id;
                $std = $db->prepare($sql);
                $success = $std->execute();
                $result = $std->fetchAll(PDO::FETCH_OBJ);
                return $result[0];

            } catch (Exception $e) {
                echo " ";
            }
        }

        public static function edit($put, $id) {
            global $db;
//            var_dump($put['ativa']);
            if ($put['ativa'] != null) {
                $status = 1;
            } else
                $status = 0;
            try {
                $sql = "UPDATE fase SET titulo = '{$put['titulo']}', conteudo = '{$put['descricao']}', ordem = '{$put['order']}', ativa = '{$status}', id_trilha = {$put['trilha']} WHERE id='{$id}'";
                var_dump($sql);
                $std = $db->prepare($sql);
                $success = $std->execute();
                if ($success)
                    echo "Sucesso";
                else
                    echo "falhou";

            } catch (Exception $e) {
                echo "Erro ao gravar os dados";
            }
        }

        public static function delete($id) {
            global $db;

            try {
                $sql = 'DELETE FROM fase WHERE id=' . $id;
                $std = $db->prepare($sql);
                $success = $std->execute();

            } catch (Exception $e) {
                echo "Erro ao deletar o registro";
            }
        }
    }