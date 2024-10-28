<?php
/**
* Pagina para juego de carta.
*
* @author Muhammad
* @version 2.0
*/
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Curriculum">
    <link rel="stylesheet" type="text/css" href="styles\css.css">
    <title>Card Game</title>
</head>

<body>
    <?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/includes/header.inc.php');
    ?>

    <?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/includes/arrayOfDeck.inc.php');
    ?>

    <?php
    shuffle($deck);

    // Nombres de los jugadores
    $players = ['Gustavo', 'Celia', 'Victor', 'Marlon', 'Eric', 'Banca'];
    $hands = [];
    
    // Repartir las cartas de forma inicial
    for ($i = 0; $i < 2; $i++) { // 2 cartas por jugador
        foreach ($players as $index => $player) {
            $hands[$player][] = array_pop($deck); // Obtiene la última carta del mazo
        }
    }
    
    // Calcular y mostrar puntuaciones directamente
    $scores = [];
    foreach ($players as $player) {
        $score = 0;
        $aceCount = 0;
    
        // Calcular la puntuación inicial para las primeras dos cartas
        foreach ($hands[$player] as $card) {
            $value = $card['value'];
            if (in_array($value, ['J', 'Q', 'K'])) {
                $score += 10; // Valor de figuras
            } elseif ($value === '1') {
                $score += 11; // AS cuenta como 11
                $aceCount++; // Contar AS
            } else {
                $score += (int)$value; // Sumar valor numérico
            }
        }

        // Ajustar los Ases si la puntuación inicial supera 21
        while ($score > 21 && $aceCount > 0) {
            $score -= 10; // Convertir As de 11 a 1
            $aceCount--;
        }
    
        // Si la puntuación inicial es menor a 14, repartir más cartas
        while ($score < 14) {
            $card = array_pop($deck);
            $hands[$player][] = $card;
    
            // Calcular el valor de la nueva carta añadida
            $value = $card['value'];
            if (in_array($value, ['J', 'Q', 'K'])) {
                $score += 10; // Valor de figuras
            } elseif ($value === '1') {
                $score += 11; // AS cuenta como 11
                $aceCount++; // Contar AS
            } else {
                $score += (int)$value; // Sumar valor numérico
            }
    
            // Ajustar AS si la puntuación es mayor a 21
            while ($score > 21 && $aceCount > 0) {
                $score -= 10; // Convertir As de 11 a 1
                $aceCount--;
            }
        }
        $scores[$player] = $score; // Guardar la puntuación final
    }
    
    // Guardar la puntuación de la banca para compararla después
    $bancaScore = $scores['Banca'];
    // Mostrar resultados de los jugadores primero, excluyendo la banca
    foreach ($players as $player) {
        echo '<h2>' . $player . ' tiene una puntuación de: ' . $scores[$player] . '</h2>';
    
        // Mostrar las cartas del jugador
        echo '<div>';
        foreach ($hands[$player] as $card) {
            echo '<img src="' . $card['image'] . '" alt="' . $card['suit'] . ' ' . $card['value'] . '" class="carta">';
        }
        echo '</div>';
    
        // Mostrar el resultado del jugador debajo de las cartas
        if ($player !== 'Banca') {
            if ($scores[$player] > 21) {
                echo '<h2>' . $player . ' ha perdido (se pasó de 21).</h2>';
            } elseif ($scores[$player] > $bancaScore && $scores[$player] <= 21) {
                echo '<h2>' . $player . ' ha ganado!</h2>';
            } elseif ($bancaScore > 21 && $scores[$player] <= 21) {
                echo '<h2>' . $player . ' ha ganado! (la banca se pasó de 21).</h2>';
            } elseif ($scores[$player] == $bancaScore) {
                echo '<h2>' . $player . ' empató con la banca.</h2>';
            } else {
                echo '<h2>' . $player . ' ha perdido (menor que la banca).</h2>';
            }
        }
    }
    ?>

    <?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.inc.php');
    ?>
</body>
</html>