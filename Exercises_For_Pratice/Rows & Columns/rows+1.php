<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$array = [];

echo "<h3>Matriz original:</h3>";

echo "<table border='1' cellpadding='10' cellspacing='0'>";
for ($i = 0; $i < 10; $i++) {
    echo "<tr>"; // Iniciar una nueva fila
    for ($j = 0; $j < 10; $j++) {
        $array[$i][$j] = rand(0, 9);
        echo "<td>" . $array[$i][$j] . "</td>";
    }
    echo "</tr>"; 
}
echo "</table>";

// Mostrar la matriz modificada en formato de tabla
echo "<h3>Matriz modificada:</h3>";
echo "<table border='1' cellpadding='10' cellspacing='0'>";
for ($i = 0; $i < 10; $i++) {
    echo "<tr>"; // Iniciar una nueva fila
    for ($j = 0; $j < 10; $j++) {
        $array[$i][$j] = $array[$i][$j] + 1; // Sumar 1
        if ($array[$i][$j] == 10) {
            $array[$i][$j] = 0; // Cambiar 10 a 0
        }
        echo "<td>" . $array[$i][$j] . "</td>";
    }
    echo "</tr>"; 
}
echo "</table>";
?>
</body>
</html>
