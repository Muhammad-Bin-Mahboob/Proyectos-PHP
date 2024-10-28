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
    <meta name="description" content="Curriculum">
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
        <h2>Skills:</h2>
        <p>En el 1 DAW he aprendido varios lenguaje de marca y de programacion.</p>
        <div class="ctn-skills">

            <div class="skill">
                <h3>Java:</h3>
                <p>
                    Java es un lenguaje de programación orientado a objetos, conocido por su portabilidad entre plataformas gracias a la Máquina Virtual de Java (JVM). Permite escribir código que puede ejecutarse en cualquier sistema operativo, siempre que tenga una JVM. Es robusto, seguro y ampliamente utilizado en desarrollo de aplicaciones web, móviles y sistemas empresariales.
                </p>
                <img src="imagenes/java.jpg" alt="java" class="foto">
            </div>

            <div class="skill">
                <h3>JavaScript:</h3>
                <p>
                JavaScript es un lenguaje de programación interpretado, ampliamente utilizado para el desarrollo web. Permite crear páginas interactivas y dinámicas al ejecutarse directamente en los navegadores. A diferencia de Java, es un lenguaje basado en prototipos y no requiere compilación. Además, JavaScript es fundamental para tecnologías como HTML y CSS, y se utiliza tanto en el lado del cliente como del servidor (con Node.js).
                </p>
                <img src="imagenes/javaScript.jpg" alt="javaScript" class="foto">
            </div>

            <div class="skill">
                <h3>HTML:</h3>
                <p>
                HTML (HyperText Markup Language) es el lenguaje estándar para crear y estructurar páginas web. Utiliza etiquetas para definir elementos como textos, imágenes, enlaces, y otros contenidos multimedia, formando la estructura básica de una página. HTML no es un lenguaje de programación, sino un lenguaje de marcado que trabaja junto con CSS y JavaScript para diseñar y hacer interactivos los sitios web.
                </p>
                <img src="imagenes/html.jpg" alt="html" class="foto">
            </div>

            <div class="skill">
                <h3>Css:</h3>
                <p>
                CSS (Cascading Style Sheets) es un lenguaje de diseño que se utiliza para controlar la apariencia y el estilo de una página web. Permite aplicar formatos como colores, fuentes, márgenes, y distribuciones de los elementos HTML, separando el contenido de la presentación. Gracias a CSS, los desarrolladores pueden crear diseños visualmente atractivos y responsivos para diferentes dispositivos y tamaños de pantalla.
                </p>
                <img src="imagenes/css.png" alt="css" class="foto">
            </div>

            <div class="skill">
                <h3>Xml:</h3>
                <p>
                XML (Extensible Markup Language) es un lenguaje de marcado utilizado para almacenar y transportar datos de manera estructurada. A diferencia de HTML, que define cómo se presenta el contenido, XML se enfoca en definir una estructura jerárquica de información mediante etiquetas personalizadas. Es flexible y extensible, lo que permite su uso en una variedad de aplicaciones, como la transmisión de datos entre sistemas y el almacenamiento de configuraciones. XML es independiente de la plataforma y ampliamente utilizado en tecnologías web y servicios.
                </p>
                <img src="imagenes/xml.png" alt="xml" class="foto">
            </div>

            <h3>Tambien he aprendido a trabajar con los Bases de Datos de:</h3>

            <div class="skill">
                <h3>MySql:</h3>
                <p>
                MySQL es un sistema de gestión de bases de datos relacional de código abierto. Utiliza SQL (Structured Query Language) para gestionar y manipular datos. Es conocido por su rapidez, fiabilidad y facilidad de uso, y es ampliamente utilizado en aplicaciones web y empresariales para almacenar y gestionar grandes volúmenes de información. MySQL es parte del stack LAMP (Linux, Apache, MySQL, PHP/Perl/Python) y es compatible con varios sistemas operativos.
                </p>
                <img src="imagenes/mySQL.webp" alt="MySql" class="foto">
            </div>

            <div class="skill">
                <h3>MongoDB:</h3>
                <p>
                MongoDB es una base de datos NoSQL orientada a documentos que almacena datos en formato JSON (BSON internamente), lo que permite mayor flexibilidad para manejar estructuras de datos no estructuradas o semi-estructuradas. A diferencia de las bases de datos relacionales, MongoDB no utiliza tablas ni filas, sino colecciones y documentos, lo que facilita el escalado horizontal y el manejo de grandes volúmenes de datos. Es popular en aplicaciones modernas, especialmente aquellas que requieren una alta disponibilidad y escalabilidad, como en el desarrollo de aplicaciones web y móviles.
                </p>
                <img src="imagenes/mongoDB.webp" alt="MongoDB" class="foto">
            </div>
        </div>
    </div>

    <?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.inc.php');
    ?>
</body>
</html>