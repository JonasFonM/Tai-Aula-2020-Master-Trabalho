<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

include '../../control/LocacaoController.php';
include '../../model/ClienteModel.php';
include '../../model/VeiculoModel.php';
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
    <title>Locações Registradas</title>
</head>

<body class="container-fluid bg-dark text-white">
    <a class="btn btn-danger float-right" href="../home/homeView.php">Voltar</a>
    <div class="container bg-dark text-white">
    
    <h3 class="text-center">Olá <?php echo $objUsuario->nome ?></h3>

    <br>
    <form action="formLocacaoView.php" method="POST">
        <input class="btn-sm btn-success btn-block" type="submit" value="Registrar Locação">
    </form>
    <br>

    <form action="listarLocacaoView.php" method="POST">
        
    <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Procurar: </span>
            </div>  

                <input class="form-control" type="text" name="valor" />
            <div class="input-group-append">
                <select class="form-control" name="tipo">
                    <option value="data_retirada">Data de Retirada</option>
                    <option value="data_devolucao">Data de Devolução</option>
                </select>
            
                <input class="btn btn-light" type="submit" value="Buscar">
                </div>
        </div>
    </form>
    </div>
    <br>
    <?php

    $objLocacaoController = new LocacaoController();

    if (!empty($_POST['valor'])) {
        $result = $objLocacaoController->search($_POST);
    } else {
        //Faz a chamada do metodo selectAll para conecta com o Banco de Dados
        $result = $objLocacaoController->index();
    }
    
    $objClienteModel = new ClienteModel();

    $objVeiculoModel = new VeiculoModel();
    //monta uma tabela e lista os dados atraves do foreach
    echo "
<div class='container bg-dark'>
<table class='table text-white'>
<tr>
  <th>ID</th>
  <th>Retirada</th>
  <th>Hora</th>
  <th>Devolução</th>
  <th>Hora</th>
  <th>Cliente</th>
  <th>Veículo</th>
  <th>Editar</th>
  <th>Deletar</th>
</tr>";
    foreach ($result as $item) {
        $objCliente = $objClienteModel::find($item['cliente_id'],"cliente");
        $objVeiculo = $objVeiculoModel::find($item['veiculo_id'],"veiculo");
        echo "
    <tr>
      <td>" . $item['id'] . "</td>
      <td>" . $item['data_retirada'] . "</td>
      <td>" . $item['hora_retirada'] . "</td>
      <td>" . $item['data_devolucao'] . "</td>
      <td>" . $item['hora_devolucao'] . "</td>
      <td>" . $objCliente->nome . "</td>
      <td>" . $objVeiculo->placa . "</td>
      <td><a class='btn-sm btn-light btn-block' href='formEditarLocacaoView.php?id=" . $item['id'] . "'>Editar</a></td>
      <td><a class='btn-sm btn-danger btn-block' href='formDeletarLocacaoView.php?id=" . $item['id'] . "'>Deletar</a></td>
    
    </tr>
    </div>
    ";

    }
    echo "</table>";

    ?>
</body>

</html>