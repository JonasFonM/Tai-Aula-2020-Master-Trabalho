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
    <title>Deletar Multa</title>
</head>

<body>
    <?php


    $objModel = new Model();

    $objModel->connection();

    if (!empty($_POST['confirmar'])) {
 
        $objModel->deletar($_GET['id'],"multa");
    
        header("Location: listarMultaView.php");
    }
    ?>

    <form action="formDeletarMultaView.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <label>Deseja Deletar o Registro?</label>
        <input type="hidden" name="confirmar" value="ok" /> <br>
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />

        <input type="submit" value="Deletar">
    </form>
    <a href="listarMultaView.php"><button>Cancelar</button></a>
</body>

</html>