<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
// inclui o arquivo BD.php dentro deste arquivo 
//para que seus metodos fiquem visiveis
include '../../control/VeiculoController.php';
include '../../model/ClienteModel.php';
include '../../lib/util.php';

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
    <title>Document</title>
</head>

<body>
    <a href="../login/loginView.php">Sair</a>
    <h3>Olá <?php echo $objUsuario->nome ?></h3>

    <form action="formVeiculoView.php" method="POST">
        <label>Cadastrar Veículo: </label>
        <input type="submit" value="Novo">
    </form>
    <form action="listarVeiculoView.php" method="POST">
        <label>Buscar: </label>
        <input type="text" name="valor" />
        <select name="tipo">
            <option value="placa">Placa</option>
            <option value="tipo_veiculo">Tipo de Veículo</option>
        </select>
        <input type="submit" value="Buscar">
    </form>
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
<table style=''>
<tr>
  <th>ID</th>
  <th>Placa</th>
  <th>Modelo</th>
  <th>Fabricante</th>
  <th>Cliente</th>
  <th>Ação</th>
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
      <td><a href='formEditarVeiculoView.php?id=" . $item['id'] . "'>Editar</a></td>
      <td><a href='formDeletarVeiculoView.php?id=" . $item['id'] . "'>Deletar</a></td>
    </tr>
    ";

    }
    echo "</table>";

    ?>
</body>

</html>