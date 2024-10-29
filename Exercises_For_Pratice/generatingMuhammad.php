<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Act => 2</title>
</head>
<body>
    <?php
    for($i=1; $i<6; $i++){
        echo '<li><a href="#sec'.$i.'">Seccion '. $i .'</a></li>';
        switch($i) {
            case 1;
                echo '<h3>Negativo - Cero - Positivo:</h3>';
                $numero = mt_rand(-200,200);
                if ($numero<0){
                    echo '<p>El numero ' .$numero.' es negativo.<p>';
                }else if($numero>0){
                    echo '<p>El numero ' .$numero.' es positivo.<p>';
                }else{
                    echo '<p>El numero ' .$numero.' es cero.<p>';
                }
            break;
            case 2;
            $nota = mt_rand(0, 10);
            echo "<h3>Nota:</h3>";
            echo "<p>Nota generada: $nota</p>";
            echo "<p>Muhammad tiene una nota media de: ";
            switch ($nota) {
                case 0:
                case 1:
                case 2:
                    echo "insuficiente.";
                    break;
                case 3:
                case 4:
                    echo "necesita mejorar.";
                    break;
                case 5:
                    echo "aprobado justito.";
                    break;
                case 6:
                    echo "aprobado.";
                    break;
                case 7:
                    echo "notable bajo.";
                    break;
                case 8:
                    echo "notable.";
                    break;
                case 9:
                case 10:
                    echo "sobresaliente.";
                    break;
                default:
                    echo "valor no válido.";
                    break;
            }
            echo '<p>';
            break;
            case 3;
            $num = mt_rand(0, 100);
            echo "<h3>Tabla de multiplicar de ".$num.":</h3>";
            echo "<p>Número generado: $num</p>";
            echo "<table border='1'>";
            for ($j = 1; $j < 21; $j++) {
                $resultado = $num * $j;
                echo "<tr><td>$num x $j = $resultado</td></tr>";
            }
            echo "</table><br>";
            break;
            case 4;
            $fila = mt_rand(1, 10);
            $columna = mt_rand(1, 10);
            echo "<h3>Tabla de ".$fila. " filas y ".$columna." columnas:</h3>";
            echo "<table border='1'>";
            for ($j = 0; $j < $fila; $j++) {
                echo '<tr>';
                for($z = 0; $z < $columna; $z++){
                echo "<td>$j x $z</td>";
            }
            echo '</tr>';
        }
            echo "</table><br>";
            break;
            case 5;
            $valor = rand(1, 1000);
            echo "<h3>Calculo del cambio:</h3>";
            echo "<p>Total a devolver: $valor</p>";
            $billetes = [500, 200, 100, 50, 20, 10, 5, 2, 1];
            echo "<ul>";
            foreach ($billetes as $billete) {
                $cantidad = intval($valor / $billete);
                //divide el valor total entre el billete 
                //actual para determinar cuántos billetes 
                //caben en el valor.
                if ($cantidad > 0) {
                    echo "<li>$cantidad x $billete €.</li>";
                }
                $valor = $valor % $billete;
                //Actualiza la variable
                // 50 %= 20 => 2
                //valor => 10
            }
            echo "</ul>";
            break;
            }
        }
    ?>
</body>
</html>