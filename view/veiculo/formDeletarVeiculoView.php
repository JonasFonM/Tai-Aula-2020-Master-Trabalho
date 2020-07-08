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
    <title>Deletar Veículo</title>
</head>

<body class="container-fluid bg-dark">
    <?php


    $objModel = new Model();
    $objModel->connection();

    if (!empty($_POST['confirmar'])) {
        $objModel->deletar($_GET['id'],"veiculo");
        header("Location: listarVeiculoView.php");
    }
    ?>

<div class="container text-center text-white bg-dark">
    <form action="formDeletarVeiculoView.php?id=<?php echo $_GET['id']; ?>" method="POST">

        <label><h1>Deseja Deletar o Registro?</h1></label>
        <input type="hidden" name="confirmar" value="ok" /> <br>
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
        <h3> <input class="btn btn-danger btn-block" type="submit" value="Deletar"> </h3>
        
    </form>
    <a href="listarVeiculoView.php"><button class="btn btn-primary btn-block">Cancelar</button></a> 
</div>

</body>

</html>