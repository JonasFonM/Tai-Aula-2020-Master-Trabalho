<?php
// inclui o arquivo BD.php dentro deste arquivo 
//para que seus metodos fiquem visiveis
include '../../control/VeiculoController.php';
include '../../model/ClienteModel.php';
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
    <title>Cadastre um Veículo</title>
</head>

<body class="container-fluid bg-dark">

    <div class="container text-center bg-dark text-white">
        <br>
        <h1>Cadastre um novo Veiculo<h1>
    </div>

    <?php

    $objVeiculoController = new VeiculoController();

    if (!empty($_POST)) {
        //chama o metodo INSERT recebendo os dados do usuário através do metodo $_POST
        $objVeiculoController->create($_POST);
    }

    $objClienteModel = new ClienteModel();
    $resultClientes =  $objClienteModel::selectAll();

    ?>

    <!-- propriedade action faz a chamada do BD.php para pegar o valor do form
        o restante e um formulario comum usando o metodo POST
    -->
    <div class="container text-white bg-dark">

    <form action="formVeiculoView.php" method="POST">

        <div class="form-group">
           <label>Cliente</label>
             <select class="form-control"s name="cliente_id">
                <?php
                foreach ($resultClientes as $itens) {
                echo "<option value='" . $itens['id'] . "'>" . $itens['nome'] . "</option>";
                }
                ?>
             </select>
        </div>

        <div class="form-group">
           <label>Placa</label>
           <input class="form-control" type="text" name="placa"> <br>
        </div>

        <div class="form-group">
           <label>Tipo de Veículo</label>
           <input class="form-control" type="text" name="tipo_veiculo"> <br>
        </div>

        <div class="form-group">
           <label>Fabricante</label>
           <input class="form-control" type="text" name="fabricante"> <br>
        </div>

        <div class="form-group">
           <label>Modelo</label>
           <input class="form-control" type="text" name="modelo"> <br>
        </div>

        <br>
        <input type="submit" class="btn btn-success btn-block" value="Enviar">

        </form>
        <br>
        <a href="listarVeiculoView.php"><button type="submit" class="btn btn-primary btn-block">Voltar</button></a>
        <br>

    </div>
    
</body>

</html>