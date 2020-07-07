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
    <div class = "container-fluid">
    <form action="formLocacaoView.php" method="POST">
        <label>Data e hora da Retirada</label>
        <input type="text" name="retirada"> <br>

        <label>Data e hora da Devolução</label>
        <input type="text" name="devolucao"> <br>

        <label>Cliente</label>
        <select name="cliente_id">
            <?php
            foreach ($resultClientes as $itens) {
                echo "<option value='" . $itens['id'] . "'>" . $itens['nome'] . "</option>";
            }
            ?>
        </select>
        <label>Veículo</label>
        <select name="veiculo_id">
            <?php
            foreach ($resultVeiculos as $itens) {
                echo "<option value='" . $itens['id'] . "'>" . $itens['placa'] . "</option>";
            }
            ?>
        </select>
        <br>
        <input type="submit" value="Enviar">
    </form>
    <a href="listarLocacaoView.php"><button>Voltar</button></a>
    </div>
</body>

</html>