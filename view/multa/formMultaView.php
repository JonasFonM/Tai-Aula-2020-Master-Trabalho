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

<body>
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
    <form action="formMultaView.php" method="POST">
        <label>Valor da Multa</label>
        <input type="text" name="valor"> <br>

        <label>Data e hora da Multa</label>
        <input type="text" name="data_hora_multa"> <br>

        <label>Cliente</label>
        <select name="cliente_id">
            <?php
            foreach ($resultClientes as $itens) {
                echo "<option value='" . $itens['id'] . "'>" . $itens['nome'] . "</option>";
            }
            ?>
        </select>
        <br>
        
        <label>Veículo</label>
        <select name="veiculo_id">
            <?php
            foreach ($resultVeiculos as $itens) {
                echo "<option value='" . $itens['id'] . "'>" . $itens['placa'] . "</option>";
            }
            ?>
        </select>
        <br>
        <label>Locacao</label>
        <select name="locacao_id">
            <?php
            foreach ($resultLocacoes as $itens) {
                echo "<option value='" . $itens['id'] . "'>" . $itens['retirada'] . "</option>";
            }
            ?>
        </select>
        <br>
        <input type="submit" value="Enviar">
    </form>
    <a href="listarMultaView.php"><button>Voltar</button></a>
</body>

</html>