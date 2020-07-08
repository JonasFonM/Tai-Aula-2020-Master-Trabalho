<?php
include '../../model/VeiculoModel.php';
include '../../lib/util.php';
include '../../lib/styles.php';

session_start();

verificarLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php estilizar(); ?>
    <title>Editar Veículo</title>
</head>

<body class="container bg-dark">
    <div class="container bg-dark text-white">
        <h1>Edite o Veículo<h1>
    </div>
    <?php

   
    $objModel = new model();

    $objModel->connection();

    if (!empty($_POST)) {
   
        $objModel->update($_POST,"veiculo");
       
        header("Location: listarVeiculoView.php");
    }

 
    $objVeiculo = $objModel->find($_GET['id'],"veiculo");
    $resultCliente =  $objModel->selectAll("cliente");

    ?>

<div class="container text-white bg-dark">
    <form action="formEditarVeiculoView.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

        <div class="form-group">
            <label>Placa</label>
            <input class="form-control" type="text" name="placa" value="<?php echo $objVeiculo->placa; ?>"> 
        </div>

        <div class="form-group">
            <label>Tipo de Veículo</label>
            <input class="form-control" type="text" name="tipo_veiculo" value="<?php echo $objVeiculo->tipo_veiculo; ?>"> 
        </div>


        <div class="form-group">
            <label>Fabricante</label>
            <input class="form-control" type="text" name="fabricante" value="<?php echo $objVeiculo->fabricante; ?>"> 
        </div>

        <div class="form-group">
            <label>Modelo</label>
            <input class="form-control" type="text" name="modelo" value="<?php echo $objVeiculo->modelo; ?>"> 
        </div>

        <div class="form-group">
            <label>Cliente</label>
            <select class="form-control" name="cliente_id">
                <?php
                foreach ($resultCliente as $itens) {
                    $selected = ($itens['id'] == $objVeiculo->cliente_id ? "selected" : "");
                    echo "<option value='" . $itens['id'] . "' " . $selected . " >" .
                    $itens['nome'] . "</option>";
                }
                ?>
            </select>
        </div>
        <br>

        <input class="btn btn-success btn-block" type="submit" value="Editar">
    </form>
        <br>
        <a href="listarVeiculoView.php"><button class="btn btn-primary btn-block">Voltar</button></a>
        <br>
</div>

</body>

</html>