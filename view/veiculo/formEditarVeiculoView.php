<?php

include '../../model/VeiculoModel.php';
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
    <title>Editar Veículo</title>
</head>

<body>
    <?php

   
    $objModel = new model();

    $objModel->connection();

    if (!empty($_POST)) {
   
        $objModel->update($_POST,"veiculo");
       
        header("Location: listarVeiculoView.php");
    }

 
    $objVeiculo = $objModel->find($_GET['id'],"veiculo");
    $resultCliente =  $objModel->selectAll("cliente");

    ?>

    <form action="formEditarVeiculoView.php" method="POST">
 
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

        <label>Placa</label>
   
        <input type="text" name="placa" value="<?php echo $objVeiculo->placa; ?>"> <br>

        <label>Tipo de Veículo</label>
      
        <input type="text" name="tipo_veiculo" value="<?php echo $objVeiculo->tipo_veiculo; ?>"> <br>

        <label>Fabricante</label>
    
        <input type="text" name="fabricante" value="<?php echo $objVeiculo->fabricante; ?>"> <br>

        <label>Modelo</label>

        <input type="text" name="modelo" value="<?php echo $objVeiculo->modelo; ?>"> <br>
        
    
        <label>Cliente</label>
        <select name="cliente_id">
            <?php
  
            foreach ($resultCliente as $itens) {
 
                $selected = ($itens['id'] == $objVeiculo->cliente_id ? "selected" : "");
   
                echo "<option value='" . $itens['id'] . "' " . $selected . " >" .
                  $itens['nome'] . "</option>";
            }
            ?>
        </select>
        <br>

        <input type="submit" value="Editar">
        <a href="listarVeiculoView.php"><button>Voltar</button></a>
    </form>
</body>

</html>