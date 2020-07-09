<?php 
include '../../lib/styles.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php estilizar(); ?>
</head>

<body class="container-fluid bg-dark m-0 p-0">
      <a href="../login/loginView.php"><button class="btn btn-danger float-right">Sair</button></a>

  <div class="form-group bg-dark m-0 p-1"> 
    <h5 class="text-center bg-dark text-light"> Bem Vindo ao SisGer</h5>
  </div>

  <div class = "container-fluid m-0 p-0">

  <div class="d-flex align-items-center justify-content-center bg-secondary" > 
    <img src='../../assets/clients.png' style="width: 200px; height: 200px;" >
    <h1><a class="btn-lg btn-outline-light" href='../cliente/listarClienteView.php' >Cliente</a><h1>
  </div>

  <div class="d-flex align-items-center justify-content-center">
    <img src='../../assets/car.png' style="width: 200px; height: 200px;" >
    <h1><a class="btn-lg btn-outline-light" href='../veiculo/listarVeiculoView.php' >Veículo</a><h1>
  </div>

  <div class="d-flex align-items-center justify-content-center bg-secondary">
    <img src='../../assets/multa.png' style="width: 200px; height: 200px;" >
    <h1><a class="btn-lg btn-outline-light" href='../multa/listarMultaView.php' >Multa</a><h1>
  </div>


  <div class="d-flex align-items-center justify-content-center">   
    <img src='../../assets/locacao.png' style="width: 200px; height: 200px;" >
    <h1><a class="btn-lg btn-outline-light" href='../locacao/listarLocacaoView.php' >Locação</a><h1>
  </div>

  </div>  


</body>

</html>