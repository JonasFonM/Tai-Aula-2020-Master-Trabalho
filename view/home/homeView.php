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

<body>
  <div class = "row text-white  " style="width: 1382px; height: 500px; margin-top: 50;  background-color: #545 ">


  <div class="col" style=" background-color: #999;"> 
  <img src='../../assets/clients.png' style="width: 200px; height: 200px;" >
  <h1><a href='../cliente/listarClienteView.php' >Cliente</a><h1>
  </div>

  <div class="col">
  <img src='../../assets/car.png' style="width: 200px; height: 200px;" >
  <h1><a href='../veiculo/listarVeiculoView.php' >Veículo</a><h1>
  </div>

  <div class="col" style=" background-color: #999 ">
  <img src='../../assets/multa.png' style="width: 200px; height: 200px;" >
  <h1><a href='../multa/listarMultaView.php' >Multa</a><h1>
  </div>


  <div class="col">
  <img src='../../assets/locacao.png' style="width: 200px; height: 200px;" >
  <h1><a href='../locacao/listarLocacaoView.php' >Locação</a><h1>
  </div>

  </div>
</body>

</html>