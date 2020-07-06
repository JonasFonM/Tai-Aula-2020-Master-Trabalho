<?php
// inclui o arquivo BD.php dentro deste arquivo 
//para que seus metodos fiquem visiveis
include '../../control/ClienteController.php';
include '../../model/MunicipioModel.php';
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
    <title>Document</title>
</head>

<body>
    <?php

    $objClienteController = new ClienteController();

    if (!empty($_POST)) {
        //chama o metodo INSERT recebendo os dados do usuário através do metodo $_POST
        $objClienteController->create($_POST);
    }

    $objMunicipioModel = new MunicipioModel();
    $resultMunicipios =  $objMunicipioModel::selectAll();

    ?>

    <!-- propriedade action faz a chamada do BD.php para pegar o valor do form
        o restante e um formulario comum usando o metodo POST
    -->
    <form action="formClienteView.php" method="POST">
        <label>Nome</label>
        <input type="text" name="nome"> <br>

        <label>CPF</label>
        <input type="text" name="cpf"> <br>

        <label>Telefone</label>
        <input type="text" name="telefone"> <br>

        <label>E-mail</label>
        <input type="text" name="email"> <br>

        <label>Município</label>
        <select name="municipio_id">
            <?php
            //listagem dos municipios
            foreach ($resultMunicipios as $itens) {
                echo "<option value='" . $itens['id'] . "'>" . $itens['nome'] . "</option>";
            }
            ?>
        </select>
        <br>
        <input type="submit" value="Enviar">
    </form>
    <a href="listarClienteView.php"><button>Voltar</button></a>
</body>

</html>