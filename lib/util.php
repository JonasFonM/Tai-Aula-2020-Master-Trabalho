<?php

function verificarLogin(){
    if(empty($_SESSION['usuario'])){

        session_destroy();
        header("Location: loginView.php");
    }
}

?>