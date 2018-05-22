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

        public static function incluir($post) {
//            echo "
//                <p>{$post['title']}</p>
//                <p>{$post['description']}</p>
//                <p>{$post['order']}</p>
//                <p>{$post['status']}</p>
//            " ;
            global $db;

            try {

                $sql = "INSERT INTO fase (titulo, conteudo, ordem, ativa) VALUES (:title, :description, :order, :status)";
                $std = $db->prepare($sql);
                $std->bindParam(":title", $post['title'], PDO::PARAM_STR);
                $std->bindParam(":description", $post['description'], PDO::PARAM_STR);
                $std->bindParam(":order", $post['order'], PDO::PARAM_INT);
                $std->bindParam(":status", $post['status'], PDO::PARAM_BOOL);

                $success = $std->execute();

                if ($success)
                    echo "
                        <div class='alert alert-success alert-dismissible fade show' role='alert' id='alert'>
                            Fase incluida com sucesso.
                            <button type='button' class='close' data-dismiss='alert' arial-label='Close'>
                                <span arial-hidden='true'>&times;</span>
                            </button>
                        </div>
                    ";

                else
                    echo "
                        <div class='alert alert-danger alert-dismissible fade show' role='alert' id='alert'>
                            Falha ao incluir o registro.
                            <button type='button' class='close' data-dismiss='alert' arial-label='Close'>
                                <span arial-hidden='true'>&times;</span>
                            </button>
                        </div>
                    ";
            } catch (Exception $e) {
                echo "
                        <div class='alert alert-danger alert-dismissible fade show' role='alert' id='alert'>
                            Erro ao acessar o banco de dados!
                            <button type='button' class='close' data-dismiss='alert' arial-label='Close'>
                                <span arial-hidden='true'>&times;</span>
                            </button>
                        </div>
                    ";
            }
        }

        public function getAll() {
            global $db;

            try {
                $sql = "SELECT * FROM fase ORDER BY ordem";
                $std = $db->prepare($sql);
                $success = $std->execute();

                if ($success) {
                    $result = $std->fetchAll(PDO::FETCH_OBJ);
//                    var_dump($result);
                } else {
                    $result = "<p>Erro na busca</p>";
                }
            } catch (Exception $e) {
                $result = "<p>Erro ao conectar com o servidor!</p>";
            }
            return $result;
        }

        public function add($id) {
            global $db;

            try {
                $sql = 'SELECT * FROM fase WHERE id='. $id;
                $std = $db->prepare($sql);
                $success = $std->execute();

                if ($success) {
                    $result = $std->fetchAll(PDO::FETCH_OBJ);
//                    var_dump($result);
                    require 'view/fases/formEdit.php';
                } else {
                    echo "
                        <div class='alert alert-danger alert-dismissible fade show' role='alert' id='alert'>
                            Nenhum registro encontrado!
                            <button type='button' class='close' data-dismiss='alert' arial-label='Close'>
                                <span arial-hidden='true'>&times;</span>
                            </button>
                        </div>
                    ";
                }
            } catch (Exception $e) {
                echo "
                        <div class='alert alert-danger alert-dismissible fade show' role='alert' id='alert'>
                            Erro ao acessar o banco de dados!
                            <button type='button' class='close' data-dismiss='alert' arial-label='Close'>
                                <span arial-hidden='true'>&times;</span>
                            </button>
                        </div>
                    ";
            }
        }

        public function put($put) {
            var_dump($put);
        }
    }