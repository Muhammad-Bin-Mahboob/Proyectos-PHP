<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Act => 1</title>
</head>
<body>
<?php
$series = [
    ['name' => 'Rick y Morty', 'character' => 'Rick'],
    ['name' => 'Breaking Bad', 'character' => 'Walter White'],
    ['name' => 'Rick y Morty', 'character' => 'Morty'],
    ['name' => 'Better Call Saul', 'character' => 'Saul Goodman'],
    ['name' => 'Breaking Bad', 'character' => 'Jessi Pinkman'],
    ['name' => 'Rick y Morty', 'character' => 'Beth']
];

$sortedNames = [];
foreach ($series as $serie) {
    $sortedNames[] = $serie['name'];
}
sort($sortedNames);
//print_r($sortedNames);

$sortedCharacters = [];
foreach ($series as $serie) {
    $sortedCharacters[] = $serie['character'];
}
sort($sortedCharacters);
//print_r($sortedCharacters);

$shownSeries = [];

foreach ($sortedNames as $serieName) {
    if (!in_array($serieName, $shownSeries)) {
        echo '<h3>' . $serieName . '</h3>';
        $shownSeries[] = $serieName;

        // Imprimir todos los personajes de la serie
        foreach ($sortedCharacters as $character) {
            foreach ($series as $innerSerie) {
                if ($innerSerie['name'] === $serieName && $innerSerie['character'] === $character) {
                    echo $character . "<br>"; // Imprimir el personaje actual
                }
            }
        }
    }
}
// Resultado
// Rick y Morty
// Rick
// Morty
// Beth

// Breaking Bad
// Walter White
// Jessi Pinkman

// Better Call Saul
// Saul Goodman


// $shownSeries = false;
// foreach ($series as $serie) {
//     if ($serie['name'] === 'Rick y Morty') {
//         if ($shownSeries == false) {
//             echo '<h3>'.$serie['name'].'</h3>';
//             $shownSeries = true;
//         }
//         echo $serie['character'] . "<br>";
//     }
// }
// Resultado:
// Rick y Morty
// Rick
// Morty
// Beth

?>
</body>
</html>