<?php
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
    <title>Editar Cliente</title>
</head>

<body class="container bg-dark">
    <div class="container bg-dark text-white">
        <h1>Edite o Cliente<h1>
    </div>
    <?php

    $objModel = new model();
  
    $objModel->connection();

    if (!empty($_POST)) {
        $objModel->update($_POST,"cliente");

        header("Location: listarClienteView.php");
    }

    $objCliente = $objModel->find($_GET['id'],"cliente");
    $resultMunicipio =  $objModel->selectAll("municipio");

    ?>

<div class="container text-white bg-dark">
    <form action="formEditarClienteView.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

        <div class="form-group">
            <label>Nome</label>
            <input class="form-control" type="text" name="nome" value="<?php echo $objCliente->nome; ?>"> <br>
        </div>

        <div class="form-group">
            <label>CPF</label>
            <input class="form-control" type="text" name="cpf" value="<?php echo $objCliente->cpf; ?>"> <br>
        </div>

        <div class="form-group">
            <label>Telefone</label>
            <input class="form-control" type="text" name="telefone" value="<?php echo $objCliente->telefone; ?>"> <br>
        </div>

        <div class="form-group">
            <label>E-mail</label>
            <input class="form-control" type="text" name="email" value="<?php echo $objCliente->email; ?>"> <br>
        </div>

        <div class="form-group">
            <label>Data de Nascimento</label>
            <input class="form-control" type="text" name="data_nasc" value="<?php echo $objCliente->data_nasc; ?>"> <br>
        </div>

        <div class="form-group">
            <label>Município</label>
            <select class="form-control" name="municipio_id">
                <?php
                foreach ($resultMunicipio as $itens) {
                    $selected = ($itens['id'] == $objCliente->municipio_id ? "selected" : "");
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
        <a href="listarClienteView.php"><button class="btn btn-primary btn-block">Voltar</button></a>
        <br>
</div>

</body>

</html>