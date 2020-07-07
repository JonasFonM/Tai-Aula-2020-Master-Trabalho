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

<body>
    <div class = "container">
    <a href="../home/homeView.php">Sair</a>
    <h3>Olá <?php echo $objUsuario->nome ?></h3>

    <form action="formMultaView.php" method="POST">
        <label>Registrar Multa: </label>
        <input type="submit" value="Novo">
    </form>
    <form action="listarMultaView.php" method="POST">
        <label>Buscar: </label>
        <input type="text" name="valor" />
        <select name="tipo">
            <option value="valor">Valor da Multa</option>
            <option value="data_hora_multa">Data e hora da Multa</option>
        </select>
        <input type="submit" value="Buscar">
    </form>
    </div>
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
<table class = 'container'>
<tr>
  <th>ID</th>
  <th>Valor da Multa</th>
  <th>Data e hora da Multa</th>
  <th>Cliente</th>
  <th>Veículo</th>
  <th>Locação</th>
  <th>Ação</th>
</tr>";
    foreach ($result as $item) {
        $objCliente = $objClienteModel::find($item['cliente_id'],"cliente");
        $objVeiculo = $objVeiculoModel::find($item['veiculo_id'],"veiculo");
        $objLocacao = $objLocacaoModel::find($item['locacao_id'],"locacao");
        echo "
    <tr>
      <td>" . $item['id'] . "</td>
      <td>" . $item['valor'] . "</td>
      <td>" . $item['data_hora_multa'] . "</td>
      <td>" . $objCliente->nome . "</td>
      <td>" . $objVeiculo->placa . "</td>
      <td>" . $objLocacao->retirada . "</td>
      <td><a href='formEditarMultaView.php?id=" . $item['id'] . "'>Editar</a></td>
      <td><a href='formDeletarMultaView.php?id=" . $item['id'] . "'>Deletar</a></td>
    </tr>
    ";

    }
    echo "</table>";

    ?>
</body>

</html>