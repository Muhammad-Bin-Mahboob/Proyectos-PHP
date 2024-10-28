<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Act => 3</title>
</head>
<body>
<?php
    $num1 = mt_rand(1,100);
    $num2 = mt_rand(1,100);

    // Operaciones
    $suma = $num1 + $num2;
    $resta = $num1 - $num2;
    $multiplicacion = $num1 * $num2;
    $division = $num2 !== 0 ? $num1 / $num2 : 'Error: División por cero.'; 
    // Verificación de división por cero
    $modulo = $num1 % $num2;

    if ($num1 > $num2) {
        $comparacion = $num1.' es mayor que '.$num2;
    } elseif ($num1 < $num2) {
        $comparacion = $num2.' es mayor que '.$num1;
    } else {
        $comparacion = 'Los números son iguales.';
    }

    // Verificación de par o impar
    $parNum1 = $num1 % 2 == 0 ? $num1.' es par' : $num1.' es impar';
    $parNum2 = $num2 % 2 == 0 ? $num2.' es par' : $num2.' es impar';

    // Mostrar resultados
    echo 'First Numero = '.$num1.'<br>';
    echo 'Second Numero = '.$num2.'<br>';
    echo 'Suma: '.$suma.'<br>';
    echo 'Resta: '.$resta.'<br>';
    echo 'Multiplicación: '.$multiplicacion.'<br>';
    echo 'División: '.$division.'<br>';
    echo 'Módulo: '.$modulo.'<br>';
    echo $comparacion.'<br>';
    echo $parNum1.'<br>';
    echo $parNum2.'<br>';
    ?>
</body>
</html>