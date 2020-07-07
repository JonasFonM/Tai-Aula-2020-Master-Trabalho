<?php

include '../../model/MultaModel.php';
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
    <title>Editar Multa</title>
</head>

<body>
    <?php

   
    $objModel = new model();

    $objModel->connection();

    if (!empty($_POST)) {
   
        $objModel->update($_POST,"multa");
       
        header("Location: listarMultaView.php");
    }

 
    $objMulta = $objModel->find($_GET['id'],"multa");
    $resultCliente = $objModel->selectAll("cliente");
    $resultVeiculo = $objModel->selectAll("veiculo");
    $resultLocacao = $objModel->selectAll("locacao");


    ?>

    <form action="formEditarMultaView.php" method="POST">
 
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

        <label>Valor da Multa</label>
   
        <input type="text" name="valor" value="<?php echo $objMulta->valor; ?>"> <br>

        <label>Data e hora da Multa</label>
      
        <input type="text" name="data_hora_multa" value="<?php echo $objMulta->data_hora_multa; ?>"> <br>

        <label>Cliente</label>
        <select name="cliente_id">
            <?php
  
            foreach ($resultCliente as $itens) {
 
                $selected = ($itens['id'] == $objMulta->cliente_id ? "selected" : "");
   
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
 
                $selected = ($itens['id'] == $objMulta->veiculo_id ? "selected" : "");
   
                echo "<option value='" . $itens['id'] . "' " . $selected . " >" .
                  $itens['placa'] . "</option>";
            }
            ?>
        </select>
        <br>

        <label>Locação</label>
        <select name="locacao_id">
            <?php
  
            foreach ($resultVeiculo as $itens) {
 
                $selected = ($itens['id'] == $objMulta->locacao_id ? "selected" : "");
   
                echo "<option value='" . $itens['id'] . "' " . $selected . " >" .
                  $itens['placa'] . "</option>";
            }
            ?>
        </select>
        <br>


        <input type="submit" value="Editar">
        <a href="listarMultaView.php"><button>Voltar</button></a>
    </form>
</body>

</html>