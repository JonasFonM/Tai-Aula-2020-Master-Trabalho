<?php

include '../../model/MultaModel.php';
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
    <title>Editar Multa</title>
</head>

<body class="container bg-dark">
    <div class="container bg-dark text-white">
        <h1>Edite a Multa<h1>
    </div>
    <?php

   
    $objModel = new model();

    $objModel->connection();

    if (!empty($_POST)) {
   
        $objModel->update($_POST,"multa");
       
        header("Location: listarMultaView.php");
    }

 
    $objMulta = $objModel->find($_GET['id'],"multa");
    $resultCliente = $objModel->selectAll("cliente");
    $resultVeiculo = $objModel->selectAll("veiculo");
    $resultLocacao = $objModel->selectAll("locacao");


    ?>
<div class="container text-white bg-dark">
    <form action="formEditarMultaView.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

        <div class="form-group">
            <label>Valor da Multa</label>
            <input class="form-control" type="text" name="valor" value="<?php echo $objMulta->valor; ?>"> 
        </div>

        <div class="form-group">
            <label>Data da Multa</label>      
            <input class="form-control" type="date" name="data_multa" value="<?php echo $objMulta->data_multa; ?>"> 
        </div>

        <div class="form-group">
            <label>Hora da Multa</label>      
            <input class="form-control" type="time" name="hora_multa" value="<?php echo $objMulta->hora_multa; ?>"> 
        </div>

        <div class="form-group">
            <label>Cliente</label>
            <select class="form-control" name="cliente_id">
                <?php
                foreach ($resultCliente as $itens) {
                    $selected = ($itens['id'] == $objMulta->cliente_id ? "selected" : "");
                    echo "<option value='" . $itens['id'] . "' " . $selected . " >" .
                    $itens['nome'] . "</option>";
                }
                ?>
            </select>
        </div>
        
        <div class="form-group">
            <label>Veículo</label>
            <select class="form-control" name="veiculo_id">
                <?php
                foreach ($resultVeiculo as $itens) {
                    $selected = ($itens['id'] == $objMulta->veiculo_id ? "selected" : "");
                    echo "<option value='" . $itens['id'] . "' " . $selected . " >" .
                    $itens['placa'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label>Locação</label>
            <select class="form-control" name="locacao_id">
                <?php
                foreach ($resultLocacao as $itens) {
                    $selected = ($itens['id'] == $objMulta->locacao_id ? "selected" : "");
                    echo "<option value='" . $itens['id'] . "' " . $selected . " >" .
                    $itens['data_retirada'] . "</option>";
                }
                ?>
            </select>
        </div>
        <br>

        <input class="btn btn-success btn-block" type="submit" value="Editar">
        
    </form>
        <br>
        <a href="listarMultaView.php"><button class="btn btn-primary btn-block">Voltar</button></a>
        <br>
</body>

</html>