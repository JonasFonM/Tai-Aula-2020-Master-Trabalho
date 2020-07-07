<?php

include '../../model/LocacaoModel.php';
include '../../lib/util.php';

session_start();

verificarLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Deletar Locação</title>
</head>

<body>
    <?php


    $objModel = new Model();

    $objModel->connection();

    if (!empty($_POST['confirmar'])) {
 
        $objModel->deletar($_GET['id'],"locacao");
    
        header("Location: listarLocacaoView.php");
    }
    ?>

    <form action="formDeletarLocacaoView.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <label>Deseja Deletar o Registro?</label>
        <input type="hidden" name="confirmar" value="ok" /> <br>
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />

        <input type="submit" value="Deletar">
    </form>
    <a href="listarLocacaoView.php"><button>Cancelar</button></a>
</body>

</html>