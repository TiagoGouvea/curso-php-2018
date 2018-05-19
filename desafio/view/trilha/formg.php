<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Trilhas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="header">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="../../index.php">Trilhas</a>
                <a class="navbar-brand" href="add.php">Adicionar</a>
            </nav>
        </div>
        <div class='containt'>
            <form method="post">
                <?php
                if (count($_GET) > 0) {

                    echo "
                              <div class='form-group'>
                                  <label for='title,'>Titulo</label>
                                  <input type='text' class='form-control' id='title' placeholder='Insira o titulo' name='title' required value={$title}>
                              </div>
                              <div class='form-group'>
                                           <label for='description'>Descrição</label>
                                   <textarea type='text' class='form-control' id='description' placeholder='Insira a descrição da Trilha' rows='10' name='description' required>{$description}</textarea>
                              </div>
                              <div class='form-group'>
                                   <label for='numFase'>Número da Trilha</label>
                                   <select class='form-control' id='numTrilha' name='numTrilha' required>
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
                }
                ?>
                <?php
                echo '
                                            <div class="form-group">
                                                <label for="title">Titulo</label>
                                                <input type="text" class="form-control" id="title" placeholder="Insira o titulo" name="title" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Descrição</label>
                                                <textarea type="text" class="form-control" id="description" placeholder="Insira a descrição da Trilha" rows="10" name="description" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="numTrilha">Número da Trilha</label>
                                                <select class="form-control" id="numTrilha" name="numTrilha" required>
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
                ?>
            </form>
        </div>
    </div>
</body>
</html>