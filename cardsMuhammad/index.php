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

    <h1>House of Cards</h1>
    <img src="imagenes\baraja-cartas.webp" alt="Yo" class="foto">

    <?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.inc.php');
    ?>
</body>
</html>