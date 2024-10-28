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
    <meta name="description" content="Presentación">
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
        <h2>Datos Personales:</h2>
        <p><b>Nombre:</b> Muhammad Bin Mahbbbob</p>
        <p><b>Edad:</b> 21 años</p>
        <p><b>Ocupacion:</b> Estudiante de 2Daw</p>
        <p><b>Fecha de Nacimiento:</b> 12/03/2003</p>
        <p><b>Telefono:</b> 631456987</p>
        <p><b>Dirección:</b> Calle Democracia 01</p>
        <p><b>Correo Electrónico:</b> muhmah3@alu.edu.gva.es</p>
        <p><b>Estado Civil:</b> Soltero</p>
        <p><b>Nacionalidad:</b> Pakistani</p>
        <p><b>Idiomas:</b> Urdu(nativo), Español (avanzado) y Inglés (avanzado)</p>
        <p><b>Nivel de Educación:</b> Hasta 1ºDesarrollo de Aplicaciones Web</p>
        <p><b>Permiso de Conducir:</b> Tipo B</p>
        <p><b>Intereses Profesionales:</b> Inteligencia Artificial y desarrollo de software ágil</p>
        <img src="imagenes/yo.jpg" alt="Yo" class="foto">
    </div>

    <?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.inc.php');
    ?>
</body>
</html>