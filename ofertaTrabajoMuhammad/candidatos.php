<?php
/**
 * Actividad para solicitud
 * 
 * @author Muhammad
 * @version 2.0
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watermark</title>
</head>
<body>
<?php
    $files = scandir($_SERVER['DOCUMENT_ROOT'] . '/imagenes/candidatos/');

    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            if (!preg_match('/-thumbnail/', $file)) {
                echo '<img src="/includes/watermark.inc.php?img=' . $file . '" alt="watermark">';
            }
        }
    }
    ?>
</body>
</html>