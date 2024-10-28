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
    $player1 = 'Alex';
    $player2 = 'Muhammad';

    // Variables para almacenar las cartas de cada jugador
    $player1_cards = [];
    $player2_cards = [];

    // Repartir las cartas de forma alternada a los dos jugadores
    for ($i = 0; $i < 20; $i++) {
        $card = array_pop($deck); // Obtiene la última carta del mazo
    
        if ($i % 2 == 0) {
            $player1_cards[] = $card; // Cartas pares para el jugador 1
        } else {
            $player2_cards[] = $card; // Cartas impares para el jugador 2
        }
    }

    echo '<h2>'. $player1 . '<h2><br>';
    foreach ($player1_cards as $card) {
        echo '<img src="' . $card['image'] . '" alt="' . $card['value'] . ' de ' . $card['suit'] . '" class="carta">';
    }

    echo '<h2>' . $player2 . '<h2><br>';
    foreach ($player2_cards as $card) {
        echo '<img src="' . $card['image'] . '" alt="' . $card['value'] . ' de ' . $card['suit'] . '" class="carta">';
    }
    ?>

    <?php
    // Inicializar puntuaciones
    $score1 = 0;
    $score2 = 0;

    // Comparar las cartas de cada jugador y calcular puntuaciones
    $val1 = 0;
    $val2 = 0;

    foreach (array_keys($player1_cards) as $index) {
        // Obtener valor de la carta del jugador 1
        $value1 = $player1_cards[$index]['value'];
        if ($value1 === 'J') {
        $val1 = 11;
        } elseif ($value1 === 'Q') {
        $val1 = 12;
        } elseif ($value1 === 'K') {
        $val1 = 13;
        } else {
        $val1 = (int)$value1;
        }

        // Obtener valor de la carta del jugador 2
        $value2 = $player2_cards[$index]['value'];
        if ($value2 === 'J') {
            $val2 = 11;
        } elseif ($value2 === 'Q') {
            $val2 = 12;
        } elseif ($value2 === 'K') {
            $val2 = 13;
        } else {
            $val2 = (int)$value2;
        }

        // Comparar los valores y actualizar la puntuación
        if ($val1 > $val2) {
            $score1 += 2;
        } elseif ($val2 > $val1) {
            $score2 += 2;
        } else {
            $score1 += 1;
            $score2 += 1;
        }
    }


    // Determinar el ganador
    echo '<h2>' . $player1.' tiene ' . $score1 . ' puntos.</h2>';
    echo '<h2>' . $player2.' tiene ' . $score2 . ' puntos.</h2>';

    if ($score1 > $score2) {
        echo '<h2>' . $player1.' ha ganado con ' . $score1 . ' puntos.</h2>';
    } elseif ($score2 > $score1) {
        echo '<h2>' . $player2.' ha ganado con ' . $score2 . ' puntos.</h2>';
    } else {
        echo '<h2>' . 'Empate con '. $score1 . ' puntos.</h2>';
    }
    ?>

    <?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.inc.php');
    ?>
</body>
</html>