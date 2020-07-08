<?php

include '../../control/LocacaoController.php';
include '../../model/ClienteModel.php';
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
    <title>Registre uma Locação</title>
</head>

<body>
<body class="container-fluid bg-dark">
    <div class="container text-center bg-dark text-white">
        <h1>Registre uma nova Locação<h1>
    </div>
    <?php

    $objLocacaoController = new LocacaoController();

    if (!empty($_POST)) {
        //chama o metodo INSERT recebendo os dados do usuário através do metodo $_POST
        $objLocacaoController->create($_POST);
    }

    $objClienteModel = new ClienteModel();
    $resultClientes =  $objClienteModel::selectAll();

    $objVeiculoModel = new VeiculoModel();
    $resultVeiculos = $objVeiculoModel::selectAll();

    ?>

    <!-- propriedade action faz a chamada do BD.php para pegar o valor do form
        o restante e um formulario comum usando o metodo POST
    -->
    <div class = "container text-white bg-dark">
    <form action="formLocacaoView.php" method="POST">
        
        <div class="form-group">
            <label>Data da Retirada</label>
            <input class="form-control" type="date" name="data_retirada">
        </div>
        
        <div class="form-group">
            <label>Hora da Retirada</label>
            <input class="form-control" type="time" name="hora_retirada">
        </div>

        <div class="form-group">
            <label>Data da Devolução</label>
            <input class="form-control" type="date" name="data_devolucao">
        </div>

        <div class="form-group">
            <label>Hora da Devolução</label>
            <input class="form-control" type="time" name="hora_devolucao">
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

        <br>

        <input class="btn btn-success btn-block" type="submit" value="Enviar">
    </form>
        <br>
        <a href="listarLocacaoView.php"><button class="btn btn-primary btn-block">Voltar</button></a>
        <br>
    </div>
</body>

</html>