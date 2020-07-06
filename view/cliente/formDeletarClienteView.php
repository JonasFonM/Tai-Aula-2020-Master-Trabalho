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
    <title>Deletar Cliente</title>
</head>

<body>
    <?php

    //cria um instancia do objeto BD
    $objModel = new Model();
    //Faz a chamada do metodo Connection para conecta com o Banco de Dados
    $objModel->connection();

    if (!empty($_POST['confirmar'])) {
        //chama o metodo DELETAR recebendo os dados do usuário através do metodo $_POST
        $objModel->deletar($_GET['id'],"cliente");
        //metodo header faz uma chamada para a tela de listagem
        //depois que realizou a adicao
        header("Location: listarClienteView.php");
    }
    ?>
    <!-- propriedade action faz a chamada do BD.php para pegar o valor do form
        o restante e um formulario comum usando o metodo POST
    -->
    <form action="formDeletarClienteView.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <label>Deseja Deletar o Registro?</label>
        <input type="hidden" name="confirmar" value="ok" /> <br>
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />

        <input type="submit" value="Deletar">
    </form>
    <a href="listarClienteView.php"><button>Cancelar</button></a>
</body>

</html>