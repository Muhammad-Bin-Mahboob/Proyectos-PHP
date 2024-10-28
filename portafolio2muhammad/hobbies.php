<?php
/**
* En esta pagina vais a ver mi perfil
*
* @autor Muhammad
* @version 2.0
*/
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Hobbies">
    <link rel="stylesheet" type="text/css" href="css/css.css">
    <title>Resapo html</title>
</head>

<body>
    <?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/includes/headOfWebsite.inc.php');
    ?>
    <header>
        <?php 
            require_once($_SERVER['DOCUMENT_ROOT'].'/includes/navigation.inc.php');
        ?>
    </header>

    <div class="center">
        <h2>Hobbies:</h2>
        <p>Mi hobby es ver películas y series, recientemente estoy viendo la serie de <i><b>Peaky Blinders.</b></i></p>
        <p class="first">"Peaky Blinders" es una serie británica ambientada en la ciudad de Birmingham, justo después de la Primera Guerra Mundial. Sigue a la familia Shelby, una banda criminal liderada por el carismático y astuto Tommy Shelby. La familia controla una organización criminal conocida como los Peaky Blinders, famosa por coser cuchillas en los bordes de sus gorras planas. A lo largo de la serie, los Shelby buscan expandir su poder e influencia mientras enfrentan conflictos con otras bandas, la policía, políticos corruptos, y amenazas internacionales, todo mientras Tommy lucha con sus propios demonios internos. La serie combina intriga política, violencia y drama familiar.</p>
        <img src="Imagenes/peaky.webp" alt="Peaky" class="foto">
        <p>También soy fan de los videojuegos, y mi videojuego favorito es <i><b>Elden Ring</b></i>.</p>
        <p class="first">Elden Ring es un videojuego de acción y rol en un vasto mundo abierto llamado <b>The Lands Between</b>, donde el protagonista, el Sinluz, debe reunir los fragmentos del Elden Ring, un artefacto sagrado destruido que ha sumido al reino en el caos. Desarrollado por <b>FromSoftware</b> y con una colaboración narrativa de <b>George R.R. Martin</b>, el juego ofrece una experiencia desafiante llena de magia, criaturas sobrenaturales y un rico mundo por explorar mientras el Sinluz lucha por restaurar el equilibrio y el orden en el reino.</p>
        <img src="Imagenes/eldenRing.jpg" alt="Ring" class="foto">
    </div>
    
    <?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.inc.php');
    ?>
</body>
</html>