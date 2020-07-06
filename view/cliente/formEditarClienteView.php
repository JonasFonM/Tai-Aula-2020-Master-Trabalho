<?php
// inclui o arquivo BD.php dentro deste arquivo 
//para que seus metodos fiquem visiveis
include '../../model/ClienteModel.php';
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

    //cria um instancia do objeto BD
    $objModel = new model();
    //Faz a chamada do metodo Connection para conecta com o Banco de Dados
    $objModel->connection();

    if (!empty($_POST)) {
        //chama o metodo UPDATE recebendo os dados do usuário através do metodo $_POST
        $objModel->update($_POST,"cliente");
        //metodo header faz uma chamada para a tela de listagem
        //depois que realizou a edicao
        header("Location: listarClienteView.php");
    }

    //Busca os dados no banco de dados pelo ID da URL passando como parametro no metodo FIND
    $objCliente = $objModel->find($_GET['id'],"cliente");
    $resultMunicipio =  $objModel->selectAll("municipio");

    ?>

    <form action="formEditarClienteView.php" method="POST">
        <!-- Input Hidden tag que fica oculta para receber o valor do ID do form--->
        <!-- passo os id para a propriedade value -->
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

        <label>Nome</label>
        <!-- passo valor do atributo nome para a propriedade value -->
        <input type="text" name="nome" value="<?php echo $objCliente->nome; ?>"> <br>

        <label>CPF</label>
        <!-- passo valor do atributo cpf para a propriedade value -->
        <input type="text" name="cpf" value="<?php echo $objCliente->cpf; ?>"> <br>

        <label>Telefone</label>
        <!-- passo valor do atributo telefone para a propriedade value -->
        <input type="text" name="telefone" value="<?php echo $objCliente->telefone; ?>"> <br>

        <label>E-mail</label>
        <!-- passo valor do atributo e-mail para a propriedade value -->
        <input type="text" name="email" value="<?php echo $objCliente->email; ?>"> <br>

        <label>Município</label>
        <select name="municipio_id">
            <?php
            //percorre os municipios 
            foreach ($resultMunicipio as $itens) {
                // operador ternario IF para verificar se o id do municipio da listagem é o mesmo ID do campo municipio_id do cliente
                $selected = ($itens['id'] == $objCliente->municipio_id ? "selected" : "");
                // se a operação a cima for verdadeiro ele vai setar o municipio correto na Tag Select
                echo "<option value='" . $itens['id'] . "' " . $selected . " >" .
                  $itens['nome'] . "</option>";
            }
            ?>
        </select>
        <br>

        <input type="submit" value="Editar">
        <a href="listarClienteView.php"><button>Voltar</button></a>
    </form>
</body>

</html>