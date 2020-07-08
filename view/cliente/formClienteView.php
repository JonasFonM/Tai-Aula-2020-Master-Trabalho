<?php
// inclui o arquivo BD.php dentro deste arquivo 
//para que seus metodos fiquem visiveis
include '../../control/ClienteController.php';
include '../../model/MunicipioModel.php';
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
    <title>Cadastrar Cliente</title>
</head>

<body class="container-fluid bg-dark">
    <div class="container text-center bg-dark text-white">
        <h1>Cadastre um novo Cliente<h1>
</div>

    <?php

    $objClienteController = new ClienteController();

    if (!empty($_POST)) {
        //chama o metodo INSERT recebendo os dados do usuário através do metodo $_POST
        $objClienteController->create($_POST);
    }

    $objMunicipioModel = new MunicipioModel();
    $resultMunicipios =  $objMunicipioModel::selectAll();

    ?>

    <!-- propriedade action faz a chamada do BD.php para pegar o valor do form
        o restante e um formulario comum usando o metodo POST
    -->
    <div class="container text-white bg-dark">
    <form action="formClienteView.php" method="POST">
        
        <div class="form-group">
            <label>Nome</label>
            <input class="form-control" type="text" name="nome" > 
        </div>

        <div class="form-group">
            <label>CPF</label>
            <input class="form-control" type="text" name="cpf"> 
        </div>

        <div class="form-group">
            <label>Telefone</label>
            <input class="form-control" type="text" name="telefone"> 
        </div>

        <div class="form-group">
            <label>E-mail</label>
            <input class="form-control" type="text" name="email"> 
        </div>

        <div class="form-group">
            <label>Data de Nascimento</label>
            <input class="form-control" type="text" name="data_nasc" placeholder="AAAA-MM-DD"> 
        </div>

        <div class="form-group">
            <label>Município</label>
            <select class="form-control" name="municipio_id">
                <?php
           
                foreach ($resultMunicipios as $itens) {
                    echo "<option value='" . $itens['id'] . "'>" . $itens['nome'] . "</option>";
                }
                ?>
            </select>
        </div>

        <br>

        <input type="submit" class="btn btn-success btn-block" value="Enviar">

    </form>
        <br>
        <a href="listarClienteView.php"><button type="submit" class="btn btn-primary btn-block">Voltar</button></a>
        <br>
</div>
    
</body>

</html>