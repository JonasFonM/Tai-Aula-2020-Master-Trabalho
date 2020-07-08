<?php

include '../../control/MultaController.php';
include '../../model/ClienteModel.php';
include '../../model/VeiculoModel.php';
include '../../model/LocacaoModel.php';
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
    <title>Registre uma Multa</title>
</head>

<body class="container-fluid bg-dark">
    <div class="container text-center bg-dark text-white">
        <h1>Registre uma nova Multa<h1>
</div>
    <?php

    $objMultaController = new MultaController();

    if (!empty($_POST)) {
        //chama o metodo INSERT recebendo os dados do usuário através do metodo $_POST
        $objMultaController->create($_POST);
    }

    $objClienteModel = new ClienteModel();
    $resultClientes =  $objClienteModel::selectAll();

    $objVeiculoModel = new VeiculoModel();
    $resultVeiculos = $objVeiculoModel::selectAll();

    $objLocacaoModel = new LocacaoModel();
    $resultLocacoes = $objLocacaoModel::selectAll();

    ?>

    <!-- propriedade action faz a chamada do BD.php para pegar o valor do form
        o restante e um formulario comum usando o metodo POST
    -->
<div class="container text-white bg-dark">
    <form action="formMultaView.php" method="POST">
       
        <div class="form-group">
            <label>Valor da Multa</label>
            <input class="form-control" type="text" name="valor"> 
        </div>

        <div class="form-group">
            <label>Data da Multa</label>
            <input class="form-control" type="date" name="data_multa"> 
        </div>

        <div class="form-group">
            <label>Hora da Multa</label>
            <input class="form-control" type="time" name="hora_multa"> 
        </div>

        <div class="form-group">
            <label>Cliente</label>
            <select class="form-control" name="cliente_id">
                <?php
                foreach ($resultClientes as $itens) {
                    echo "<option value='" . $itens['id'] . "'>" . $itens['nome'] . "</option>";
                }
                ?>
            </select>
        </div>
        
        <div class="form-group">
            <label>Veículo</label>
            <select class="form-control" name="veiculo_id">
                <?php
                foreach ($resultVeiculos as $itens) {
                    echo "<option value='" . $itens['id'] . "'>" . $itens['placa'] . "</option>";
                }
                ?>
            </select>
        </div>
        
        <div class="form-group">
            <label>Locacao</label>
            <select class="form-control" name="locacao_id">
                <?php
                foreach ($resultLocacoes as $itens) {
                    echo "<option value='" . $itens['id'] . "'>" . $itens['data_retirada'] . "</option>";
                }
                ?>
            </select>
        </div>

        <br>

        <input class="btn btn-success btn-block" type="submit" value="Enviar">
    </form>
        <br>
        <a href="listarMultaView.php"><button class="btn btn-primary btn-block">Voltar</button></a>
        <br>
</div>

</body>

</html>