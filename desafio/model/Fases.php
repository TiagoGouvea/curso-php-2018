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

        public static function add($id) {
            global $db;

            try {
                $sql = 'SELECT * FROM fase WHERE id='. $id;
                $std = $db->prepare($sql);
                $success = $std->execute();

                if ($success) {
                    $result = $std->fetchAll(PDO::FETCH_OBJ);
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

        public static function edit($put) {
            global $db;

            if ($put['status'] == 'on') {
                $status = 1;
            } else
                $status = 0;
            try {
                $sql = "UPDATE fase SET titulo = '{$put['title']}', conteudo = '{$put['description']}', ordem = '{$put['order']}', ativa = '{$status}' WHERE id='{$put['id']}'";
                $std = $db->prepare($sql);
                $success = $std->execute();

                if ($success)
                    echo "
                        <div class='alert alert-success alert-dismissible fade show' role='alert' id='alert'>
                            Fase alterada com sucesso.
                            <button type='button' class='close' data-dismiss='alert' arial-label='Close'>
                                <span arial-hidden='true'>&times;</span>
                            </button>
                        </div>
                    ";

                else
                    echo "
                        <div class='alert alert-danger alert-dismissible fade show' role='alert' id='alert'>
                            Falha ao alterar o registro.
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

        public static function delete($id) {
            global $db;

            try {
                $sql = 'DELETE FROM fase WHERE id=' . $id;
                $std = $db->prepare($sql);
                $success = $std->execute();

                if ($success)
                    echo "
                        <div class='alert alert-success alert-dismissible fade show' role='alert' id='alert'>
                            Fase excluida com sucesso.
                            <button type='button' class='close' data-dismiss='alert' arial-label='Close'>
                                <span arial-hidden='true'>&times;</span>
                            </button>
                        </div>
                    ";

                else
                    echo "
                        <div class='alert alert-danger alert-dismissible fade show' role='alert' id='alert'>
                            Falha ao excluir o registro.
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
    }