<?php
    require_once "conexao.php";

    if (count($_POST) > 0) {
        if (count($_GET) > 0) {
             echo "<pre>";
             var_dump($_POST);
             echo "</pre>";
            $title = $_POST['title'];
            $description = $_POST['description'];
            $order = $_POST['numFase'];
            $status = $_POST['status'];
            if ($status == 'checked')
                $status = 1;
            else
                $status = 0;
            
            try {
                $sql = "UPDATE fase SET 
                    titulo = '$title',
                    conteudo = '$description',
                    ordem = '$order',
                    ativa = '$status'
                    WHERE id={$_GET['id']}
                ";
                // echo "<pre>";
                // var_dump($sql);
                // echo "</pre>";    
                $std = $db->prepare($sql);
                $success = $std->execute();

                if ($success) {
                    $sql = "SELECT * FROM fase WHERE id={$_GET['id']}";
                    $std = $db->prepare($sql);

                    //================

                    //================
                    
                    echo "<p>Fase atualizada!</p>";
                } else {
                    echo "<p>Erro ao atualizar fase!</p>";
                }

            } catch (Exception $e) {
                echo "<p>Erro ao acessar o servidor</p>";
            }
        }else { 
            try {
                $sql = "
                INSERT INTO fase (
                    titulo, 
                    conteudo, 
                    ordem, 
                    ativa
                ) 
                VALUES (
                    :title, 
                    :description, 
                    :numFase, 
                    :status
                )
                ";
            
                $std = $db->prepare($sql);
                $std->bindParam(":title",$_POST['title'], PDO::PARAM_STR);
                $std->bindParam(":description", $_POST['description'], PDO::PARAM_STR);
                $std->bindParam(":numFase", $_POST['numFase'], PDO::PARAM_INT);
                $std->bindParam(":status", $_POST['status'], PDO::PARAM_BOOL);
                $success = $std->execute();
                if ($success)
                    echo "<p>Registro incluído</p>";
                else
                    echo "<p>Falha ao incluir o registro</p>";
            } catch (Exception $e) {
                echo "<p>Erro ao de comunicação com o servidor</p>";
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Fases</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="header">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="index.php">Fases</a>
                    <a class="navbar-brand" href="add.php">Adicionar</a>
                </nav>
            </div>
            <div class='containt'>
                <form method="post">
                <?php 
                    if (count($_GET) > 0) {
                        $sql = "SELECT * FROM fase WHERE id={$_GET['id']}";
                        $std = $db->prepare($sql);
                        $success = $std->execute();

                        if ($success) {
                            $result = $std->fetchAll(PDO::FETCH_OBJ);
                            $title = $result[0]->titulo;
                            $description = $result[0]->conteudo;
                            $order = $result[0]->ordem;
                            $status = $result[0]->ativa;
                            //var_dump($status);
                            if ($status != '1')
                                $status = false;
                            else
                                $status = true; 
                            
                            echo "
                                    <div class='form-group'>
                                        <label for='title,'>Titulo</label>
                                        <input type='text' class='form-control' id='title' placeholder='Insira o titulo' name='title' required value={$title}>
                                    </div>
                                    <div class='form-group'>
                                        <label for='description'>Descrição</label>
                                        <textarea type='text' class='form-control' id='description' placeholder='Insira a descrição da fase' rows='10' name='description' required>{$description}</textarea>
                                    </div>
                                    <div class='form-group'>
                                        <label for='numFase'>Número da Fase</label>
                                        <select class='form-control' id='numFase' name='numFase' required>
                                            ";
                                            while ($i < 20) {
                                                $j = $i + 1;
                                                if ($j == $order) {
                                                    //echo $order;
                                                    echo "<option selected>{$order}</option>";
                                                }
                                                echo "<option>{$j}</option>";
                                                $i++;
                                            }
                                            echo "
                                        </select>
                                    </div>
                                    <div class='form-group form-check'>
                                        <input type='checkbox' class='form-check-input' id='status' name='status' value={$status} checked>
                                        <label class='form-check-label' for='status'>Ativo</label>
                                    </div>
                                    <button type='submit' class='btn btn-primary'>Update</button>
                            ";
                        } else {
                            echo "<p>Erro ao acessar os dados!";
                        }
                    } else {
                ?>
                <?php
                        echo '
                                <div class="form-group">
                                    <label for="title">Titulo</label>
                                    <input type="text" class="form-control" id="title" placeholder="Insira o titulo" name="title" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Descrição</label>
                                    <textarea type="text" class="form-control" id="description" placeholder="Insira a descrição da fase" rows="10" name="description" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="numFase">Número da Fase</label>
                                    <select class="form-control" id="numFase" name="numFase" required>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                        <option>13</option>
                                        <option>14</option>
                                        <option>15</option>
                                        <option>16</option>
                                        <option>17</option>
                                        <option>18</option>
                                        <option>19</option>
                                        <option>20</option>
                                    </select>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="status" name="status" value="1" checked>
                                    <label class="form-check-label" for="status">Ativo</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                        ';
                    }
                ?>
                </form>
            </div>
        </div>
    </body>
</html>