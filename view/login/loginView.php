<?php
include '../../model/Model.php';
include '../../lib/styles.php';

session_start();

$_SESSION['usuario'] = null;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php estilizar(); ?>
    <title>Faça seu Login</title>
</head>

<body class="container text-white bg-dark">
    <?php

    if (!empty($_POST)) {
        $objUsuario =  Model::logar($_POST["login"], $_POST['senha']);
        if (!empty($objUsuario)) {
            $_SESSION['usuario'] = $objUsuario;
            header("Location: ../home/homeView.php");
        } else {
            echo "<b style='color:red;'>Login ou Senha errado, tente novamente! </b>";
        }
    }

    ?>
    <form action="loginView.php" method="POST">
        <h2 class="text-center">Bem vindo, informe suas credênciais</h2>

        <div class="form-group text-center text-white">
            <label>Login</label>
            <input class="form-control text-center" type="text" name="login">
        </div>

        <div class="form-group text-center text-white">
            <label>Senha</label>
            <input class="form-control text-center" type="password" name="senha">
        </div>

        <br>

        <input class="btn btn-success btn-block" type="submit" value="Logar">
    </form>

</body>

</html>