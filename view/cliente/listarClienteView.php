<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

include '../../control/ClienteController.php';
include '../../model/MunicipioModel.php';
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
    <title>Clientes Cadastrados</title>
</head>

<body class="container-fluid bg-dark">
    <a class="btn btn-danger float-right" href="../home/homeView.php">Voltar</a>
    <div class="container bg-dark text-white">
    
    <h3 class="text-center">Olá <?php echo $objUsuario->nome ?></h3>
    
    <br>
    <form action="formClienteView.php" method="POST">
        <input class="btn-sm btn-success btn-block" type="submit" value="Cadastrar Cliente">
    </form>
    <br>

    <form action="listarClienteView.php" method="POST">
       
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Procurar: </span>
            </div>  

                <input class="form-control" type="text" name="valor" />
            <div class="input-group-append">
                <select class="form-control" name="tipo">
                    <option value="nome">Nome</option>
                    <option value="cpf">CPF</option>
                </select>
            
                <input class="btn btn-light" type="submit" value="Buscar">
                </div>
        </div>
    </form>
    </div>
    <br>
    <?php

    $objClienteController = new ClienteController();

    if (!empty($_POST['valor'])) {
        $result = $objClienteController->search($_POST);
    } else {
        $result = $objClienteController->index();
    }
    
    $objMunicipioModel = new MunicipioModel();
    echo "
<div class='container bg-dark'>
<table class='table text-white'>
<tr>
  <th>ID</th>
  <th>Nome</th>
  <th>CPF</th>
  <th>Município</th>
  <th>UF</th>
  <th>Editar</th>
  <th>Deletar</th>
</tr>";
    foreach ($result as $item) {
        $objMunicipio = $objMunicipioModel::find($item['municipio_id']);
        echo "
    <tr>
      <td>" . $item['id'] . "</td>
      <td>" . $item['nome'] . "</td>
      <td>" . $item['cpf'] . "</td>
      <td>" . $objMunicipio->nome  . "</td>
      <td>" . $objMunicipio->uf  . "</td>
      <td><a class='btn-sm btn-light btn-block' href='formEditarClienteView.php?id=" . $item['id'] . "'>Editar</a></td>
      <td><a class='btn-sm btn-danger btn-block' href='formDeletarClienteView.php?id=" . $item['id'] . "'>Deletar</a></td>
    </tr>
    </div>
    ";
    }
    echo "</table>";

    ?>
</body>

</html>