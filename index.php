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

    header("location: view/login/loginView.php");
    // echo "Hello World2";
    $num01 = 20;
    $num02 = 10;

    $calcularSoma = soma($num01, $num02);

    echo ($calcularSoma);

    function soma($numero01, $numero02)
    {
        $soma = $numero01 + $numero02;
        return $soma;
    }
    sub($num01, $num02);

    function sub($numero01, $numero02)
    {
        $subtracao = $numero01 - $numero02;
        echo ($subtracao);
    }
    echo "<br>";
    $carro = ["Ka", "Corsa"];

    array_push($carro, "Fusca");
    array_push($carro, "Gol");
    print_r($carro);
    echo count($carro) . "<br>";

    $str = "28/02/2020";
    echo  $str . "<br>";
    $arrayExemplo = explode("/", $str);

    foreach ($arrayExemplo as $item) {
        echo $item . "<br>";
    }

    $dia = $arrayExemplo[0];
    $mes = $arrayExemplo[1];
    $ano = $arrayExemplo[2];

    print_r($arrayExemplo);

    echo "<br>Dia:" . $dia . "<br>";
    echo "Mes:" . $mes . "<br>";
    echo "Ano:" . $ano . "<br>";

    echo (__DIR__ . "<br>");
    echo (__FILE__);

    ?>
</body>

</html>