<?php
$rows = 6;
$cols = 9;

$array = [];
$uniqueNumbers = []; 

while (count($uniqueNumbers) < 900) { // Hay 900 números entre 100 y 999
    $num = rand(100, 999); // Generar un número aleatorio entre 100 y 999
    if (!in_array($num, $uniqueNumbers)) { // Comprobar si ya está en el array
        $uniqueNumbers[] = $num; // Agregarlo si no está
    }
}

shuffle($uniqueNumbers);

for ($i = 0; $i < $rows; $i++) {
    $array[$i] = [];
    for ($j = 0; $j < $cols; $j++) {
        $array[$i][$j] = array_pop($uniqueNumbers);
    }
}

foreach ($array as $row) {
    foreach ($row as $value) {
        echo $value . '  ';
    }
    echo "<br>";
}
?>