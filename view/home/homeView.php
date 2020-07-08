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
  <div class = "row p-3 my-10 bg-dark text-white">

  <div class="col"><h1><a href='../cliente/listarClienteView.php' >Cliente</a><h1></div>
  <div class="col"><h1><a href='../veiculo/listarVeiculoView.php' >Veículo</a><h1></div>
  <div class="col"><h1><a href='../multa/listarMultaView.php' >Multa</a><h1></div>
  <div class="col"><h1><a href='../locacao/listarLocacaoView.php' >Locação</a><h1></div>

  </div>
</body>

</html>