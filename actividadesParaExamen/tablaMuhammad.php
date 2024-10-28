<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Act => 4</title>
</head>
<body>
    <?php
        echo '<table border="1" cellpadding="5" cellspacing="0">';
        // Encabezado de la tabla
        echo "<tr><th>x</th>"; 
        // Rellenar las celdas vacía en la esquina 
        // superior izquierda
        for ($i = 1; $i <= 10; $i++) {
            echo "<th>$i</th>";
        }
        echo "</tr>";
        
        // Filas de la tabla
        for ($i = 1; $i <= 10; $i++) {
            echo "<tr>";
            echo "<th>$i</th>";
            //x
            //x
            //x
            //x
            //x
            // columnas de cada fila
            for ($j = 1; $j <= 10; $j++) {
                $resultado = $i * $j;
                echo "<td>$resultado</td>";
                //x x x x x x x
            }
            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>