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
    <meta name="description" content="Trabajos">
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
        <h2>Trabajos realizados:</h2>
        <h3>Burger King:</h3>
        <div class="first">
            <p>1.Responsable de proporcionar un servicio de atención al cliente excepcional en un entorno de Burger King.</p>
            <p>2.Gestionaba las necesidades de los clientes, manejaba transacciones y resolvía problemas con eficiencia y cortesía.</p>
            <p>3.Desarrollé habilidades sólidas en comunicación, trabajo en equipo y gestión del tiempo en un entorno de ritmo rápido.</p>
        </div>
        <img src="imagenes/logoBurgerKing.png" alt="Burger" class="foto">
        <h3>Profesor de Inglés en una academia:</h3>
        <div class="first">
            <p>1.Diseñé y preparé lecciones adaptadas a diferentes niveles de habilidad y estilos de aprendizaje.</p>
            <p>2.Evalué el progreso de los estudiantes y proporcioné comentarios claros para ayudarles a mejorar.</p>
            <p>3.Fomenté un entorno positivo y participativo en el aula para mantener a los estudiantes motivados y comprometidos.</p>
        </div>
        <img src="imagenes/english.jpg" alt="English" class="foto">
    </div>

    <?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.inc.php');
    ?>
</body>
</html>