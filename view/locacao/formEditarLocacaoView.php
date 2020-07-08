<?php

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
    <title>Editar Locação</title>
</head>

<body class="container bg-dark">
    <div class="container bg-dark text-white">
        <h1>Edite a Locação<h1>
    </div>
    <?php

   
    $objModel = new model();

    $objModel->connection();

    if (!empty($_POST)) {
   
        $objModel->update($_POST,"locacao");
       
        header("Location: listarLocacaoView.php");
    }

 
    $objLocacao = $objModel->find($_GET['id'],"locacao");
    $resultCliente = $objModel->selectAll("cliente");
    $resultVeiculo = $objModel->selectAll("veiculo");

    ?>
<div class="container text-white bg-dark">
    <form action="formEditarLocacaoView.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

        <div class="form-group">
            <label>Data da Retirada</label>
            <input class="form-control" type="date" name="data_retirada" value="<?php echo $objLocacao->data_retirada; ?>">
        </div>

        <div class="form-group">
            <label>Hora da Retirada</label>
            <input class="form-control" type="time" name="hora_retirada" value="<?php echo $objLocacao->hora_retirada; ?>"> 
        </div>

        <div class="form-group">
            <label>Data da Devolução</label>
            <input class="form-control" type="date" name="data_devolucao" value="<?php echo $objLocacao->data_devolucao; ?>"> 
        </div>

        <div class="form-group">
            <label>Hora da Devolução</label>
            <input class="form-control" type="time" name="hora_devolucao" value="<?php echo $objLocacao->hora_devolucao; ?>"> 
        </div>

        <div class="form-group">
            <label>Cliente</label>
            <select class="form-control" name="cliente_id">
                <?php
  
                foreach ($resultCliente as $itens) {
                    $selected = ($itens['id'] == $objLocacao->cliente_id ? "selected" : "");
                    echo "<option value='" . $itens['id'] . "' " . $selected . " >" .
                    $itens['nome'] . "</option>";
                }
                ?>
            </select>
        </div>
        
        <div class="form-group">
            <label>Veículo</label>
            <select class="form-control" name="veiculo_id">
                <?php
                foreach ($resultVeiculo as $itens) {
                    $selected = ($itens['id'] == $objLocacao->veiculo_id ? "selected" : "");
                    echo "<option value='" . $itens['id'] . "' " . $selected . " >" .
                    $itens['placa'] . "</option>";
                }
                ?>
            </select>
        </div>

        <input class="btn btn-success btn-block" type="submit" value="Editar">
     </form> 
        <br>
        <a href="listarLocacaoView.php"><button class="btn btn-primary btn-block">Voltar</button></a>
        <br>
</div>   

</body>

</html>