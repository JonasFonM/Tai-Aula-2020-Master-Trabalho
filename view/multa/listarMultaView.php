<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
// inclui o arquivo BD.php dentro deste arquivo 
//para que seus metodos fiquem visiveis
include '../../control/MultaController.php';
include '../../model/ClienteModel.php';
include '../../model/VeiculoModel.php';
include '../../model/LocacaoModel.php';
include '../../lib/util.php';
include '../../lib/styles.php';

session_start();

verificarLogin();

$objUsuario = $_SESSION['usuario'];

//var_dump( $objUsuario );
//exit;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php estilizar(); ?>
    <title>Multas Registradas</title>
</head>

<body class="container-fluid bg-dark">
    
    <a class="btn btn-danger float-right" href="../home/homeView.php">Sair</a>
    <div class = "container bg-dark text-white">
    
    <h3 class="text-center">Olá <?php echo $objUsuario->nome ?></h3>

    <br>
    <form action="formMultaView.php" method="POST">
        <input class="btn-sm btn-success btn-block" type="submit" value="Registrar Multa">
    </form>
    <br>

    <form action="listarMultaView.php" method="POST">
      <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Procurar: </span>
            </div>  

                <input class="form-control" type="text" name="valor" />
            <div class="input-group-append">
                <select class="form-control" name="tipo">
                    <option value="data_multa">Data da Multa</option>
                    <option value="valor">Valor da Multa</option>
                </select>
            
                <input class="btn btn-light" type="submit" value="Buscar">
                </div>
        </div>
    </form>
    </div>
    <br>
    <?php

    $objMultaController = new MultaController();

    if (!empty($_POST['valor'])) {
        $result = $objMultaController->search($_POST);
    } else {
        //Faz a chamada do metodo selectAll para conecta com o Banco de Dados
        $result = $objMultaController->index();
    }
    
    $objClienteModel = new ClienteModel();

    $objVeiculoModel = new VeiculoModel();

    $objLocacaoModel = new LocacaoModel();
    //monta uma tabela e lista os dados atraves do foreach
    echo "
<div class='container bg-dark'>
<table class = 'table text-white'>
<tr>
  <th>ID</th>
  <th>Valor da Multa</th>
  <th>Data da Multa</th>
  <th>Hora da Multa</th>
  <th>Cliente</th>
  <th>Veículo</th>
  <th>Locação</th>
  <th>Editar</th>
  <th>Deletar</th>
</tr>";
    foreach ($result as $item) {
        $objCliente = $objClienteModel::find($item['cliente_id'],"cliente");
        $objVeiculo = $objVeiculoModel::find($item['veiculo_id'],"veiculo");
        $objLocacao = $objLocacaoModel::find($item['locacao_id'],"locacao");
        echo "
    <tr>
      <td>" . $item['id'] . "</td>
      <td>" . $item['valor'] . "</td>
      <td>" . $item['data_multa'] . "</td>
      <td>" . $item['hora_multa'] . "</td>
      <td>" . $objCliente->nome . "</td>
      <td>" . $objVeiculo->placa . "</td>
      <td>" . $objLocacao->data_retirada . "</td>
      <td><a class='btn-sm btn-light btn-block' href='formEditarMultaView.php?id=" . $item['id'] . "'>Editar</a></td>
      <td><a class='btn-sm btn-danger btn-block' href='formDeletarMultaView.php?id=" . $item['id'] . "'>Deletar</a></td>
    </tr>
</div>
    ";

    }
    echo "</table>";

    ?>
</body>

</html>