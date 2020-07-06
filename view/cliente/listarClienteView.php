<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
// inclui o arquivo BD.php dentro deste arquivo 
//para que seus metodos fiquem visiveis
include '../../control/ClienteController.php';
include '../../model/MunicipioModel.php';
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
    <!-- formulario com o botao para chamar o arquivo formCliente -->
    <form action="formClienteView.php" method="POST">
        <label>Cadastrar Cliente: </label>
        <input type="submit" value="Novo">
    </form>
    <form action="listarClienteView.php" method="POST">
        <label>Buscar: </label>
        <input type="text" name="valor" />
        <select name="tipo">
            <option value="nome">Nome</option>
            <option value="cpf">CPF</option>
        </select>
        <input type="submit" value="Buscar">
    </form>
    <?php

    $objClienteController = new ClienteController();

    if (!empty($_POST['valor'])) {
        $result = $objClienteController->search($_POST);
    } else {
        //Faz a chamada do metodo selectAll para conecta com o Banco de Dados
        $result = $objClienteController->index();
    }
    
    $objMunicipioModel = new MunicipioModel();
    //monta uma tabela e lista os dados atraves do foreach
    echo "
<table style=''>
<tr>
  <th>ID</th>
  <th>Nome</th>
  <th>CPF</th>
  <th>Município</th>
  <th>UF</th>
  <th>Ação</th>
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
      <td><a href='formEditarClienteView.php?id=" . $item['id'] . "'>Editar</a></td>
      <td><a href='formDeletarClienteView.php?id=" . $item['id'] . "'>Deletar</a></td>
    </tr>
    ";
        //a ultima linha foi criado um link para passar o parameto do id para a pagina formEditarCliente
    }
    echo "</table>";

    ?>
</body>

</html>