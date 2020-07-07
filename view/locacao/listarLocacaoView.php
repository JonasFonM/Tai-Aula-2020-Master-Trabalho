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

<body>
    <a href="../home/homeView.php">Sair</a>
    <h3>Olá <?php echo $objUsuario->nome ?></h3>

    <form action="formLocacaoView.php" method="POST">
        <label>Registrar Locação: </label>
        <input type="submit" value="Novo">
    </form>
    <form action="listarLocacaoView.php" method="POST">
        <label>Buscar: </label>
        <input type="text" name="valor" />
        <select name="tipo">
            <option value="retirada">Retirada</option>
            <option value="devolucao">Devolução</option>
        </select>
        <input type="submit" value="Buscar">
    </form>
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
<table style=''>
<tr>
  <th>ID</th>
  <th>Retirada</th>
  <th>Devolução</th>
  <th>Cliente</th>
  <th>Veículo</th>
  <th>Ação</th>
</tr>";
    foreach ($result as $item) {
        $objCliente = $objClienteModel::find($item['cliente_id'],"cliente");
        $objVeiculo = $objVeiculoModel::find($item['veiculo_id'],"veiculo");
        echo "
    <tr>
      <td>" . $item['id'] . "</td>
      <td>" . $item['retirada'] . "</td>
      <td>" . $item['devolucao'] . "</td>
      <td>" . $objCliente->nome . "</td>
      <td>" . $objVeiculo->placa . "</td>
      <td><a href='formEditarLocacaoView.php?id=" . $item['id'] . "'>Editar</a></td>
      <td><a href='formDeletarLocacaoView.php?id=" . $item['id'] . "'>Deletar</a></td>
    </tr>
    ";

    }
    echo "</table>";

    ?>
</body>

</html>