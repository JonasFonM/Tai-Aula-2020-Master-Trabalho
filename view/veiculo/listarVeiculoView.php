<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

include '../../control/VeiculoController.php';
include '../../model/ClienteModel.php';
include '../../lib/util.php';
include '../../lib/styles.php';

session_start();

verificarLogin();

$objUsuario = $_SESSION['usuario'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php estilizar(); ?>
    <title>Veículos Cadastrados</title>
</head>

<body class="container-fluid bg-dark">
    <a class="btn btn-danger float-right" href="../home/homeView.php">Voltar</a>
    <div class="container bg-dark text-white">

    
    <h3 class="text-center">Olá <?php echo $objUsuario->nome ?></h3>

    <br>
    <form action="formVeiculoView.php" method="POST">
        <input class="btn-sm btn-success btn-block" type="submit" value="Cadastrar Veículo">
    </form>
    <br>

    <form action="listarVeiculoView.php" method="POST">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Procurar: </span>
            </div>  

                <input class="form-control" type="text" name="valor" />
            <div class="input-group-append">
                <select class="form-control" name="tipo">
                    <option value="placa">Placa</option>
                    <option value="tipo_veiculo">Tipo de Veículo</option>
                </select>
            
                <input class="btn btn-light" type="submit" value="Buscar">
                </div>
        </div>
    </form>
    </div>
    <br>
    <?php

    $objVeiculoController = new VeiculoController();

    if (!empty($_POST['valor'])) {
        $result = $objVeiculoController->search($_POST);
    } else {
        //Faz a chamada do metodo selectAll para conecta com o Banco de Dados
        $result = $objVeiculoController->index();
    }
    
    $objClienteModel = new ClienteModel();
    //monta uma tabela e lista os dados atraves do foreach
    echo "
<div class='container bg-dark'>    
<table class='table text-white'>
<tr>
  <th>ID</th>
  <th>Placa</th>
  <th>Modelo</th>
  <th>Fabricante</th>
  <th>Cliente</th>
  <th>Editar</th>
  <th>Deletar</th>
</tr>";
    foreach ($result as $item) {
        $objCliente = $objClienteModel::find($item['cliente_id']);
        echo "
    <tr>
      <td>" . $item['id'] . "</td>
      <td>" . $item['placa'] . "</td>
      <td>" . $item['modelo'] . "</td>
      <td>" . $item['fabricante'] . "</td>
      <td>" . $objCliente->nome  . "</td>
      <td><a class='btn-sm btn-light btn-block' href='formEditarVeiculoView.php?id=" . $item['id'] . "'>Editar</a></td>
      <td><a class='btn-sm btn-danger btn-block' href='formDeletarVeiculoView.php?id=" . $item['id'] . "'>Deletar</a></td>
    </tr>
    </div>
    ";

    }
    echo "</table>";

    ?>
</body>

</html>