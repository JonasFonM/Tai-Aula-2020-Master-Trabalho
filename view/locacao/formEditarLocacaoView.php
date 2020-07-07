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
    <title>Editar Locação</title>
</head>

<body>
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

    <form action="formEditarLocacaoView.php" method="POST">
 
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

        <label>Placa</label>
   
        <input type="text" name="retirada" value="<?php echo $objLocacao->retirada; ?>"> <br>

        <label>Tipo de Veículo</label>
      
        <input type="text" name="devolucao" value="<?php echo $objLocacao->devolucao; ?>"> <br>

        <label>Cliente</label>
        <select name="cliente_id">
            <?php
  
            foreach ($resultCliente as $itens) {
 
                $selected = ($itens['id'] == $objLocacao->cliente_id ? "selected" : "");
   
                echo "<option value='" . $itens['id'] . "' " . $selected . " >" .
                  $itens['nome'] . "</option>";
            }
            ?>
        </select>
        <br>
        
        <label>Veículo</label>
        <select name="veiculo_id">
            <?php
  
            foreach ($resultVeiculo as $itens) {
 
                $selected = ($itens['id'] == $objLocacao->veiculo_id ? "selected" : "");
   
                echo "<option value='" . $itens['id'] . "' " . $selected . " >" .
                  $itens['placa'] . "</option>";
            }
            ?>
        </select>
        <br>

        <input type="submit" value="Editar">
        <a href="listarLocacaoView.php"><button>Voltar</button></a>
    </form>
</body>

</html>