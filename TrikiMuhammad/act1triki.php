<?php
/**
 * 
 * @author Muhammad
 * @version 1.0
 * 
 */

if (isset($_COOKIE['style'])) {
    $style = $_COOKIE['style'];
} else {
    $style = 'dark';
}

if (isset($_GET['accept_cookies'])) {
    setcookie('cookies_accepted', '1', time() + 60); // 60 segundos
    header('Location: act1triki.php');
    exit;
}

if (isset($_GET['style']) && in_array($_GET['style'], ['dark', 'light'])) {
    $style = $_GET['style'];
    setcookie('style', $style, time() + (60 * 60 * 24 * 30)); // sec * min * horas * dias = 30 días
    header('Location: act1triki.php');
    exit;
}

if (isset($_GET['delete_cookies'])) {
    setcookie('style', '', time() - 3600);// borrar la cookie de style
    setcookie('cookies_accepted', '', time() - 3600); // borrar la cookie de accept_cookies
    header('Location: act1triki.php');
    exit;
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Triki: el monstruo de las Cookies</title>
    <link rel="stylesheet" href="css/<?php echo $style; ?>.css">
</head>
<body>
    <?php if (!isset($_COOKIE['cookies_accepted'])) { ?>
        <div id="cookies">
            Este sitio web utiliza cookies propias y puede que de terceros.<br>
            Al utilizar nuestros servicios, aceptas el uso que hacemos de las cookies.<br>
            <div><a href="act1triki.php?accept_cookies=1">ACEPTAR</a></div>
        </div>
    <?php } ?>
        <h1>Bienvenido a la web de Triki, el monstruo de las cookies</h1>
        <h2>Bienvenido a la web donde no se gestionan las cookies, se devoran.</h2>
        <img src="/img/triki.jpg" alt="Imagen de Triki mirando una galleta">
        <div id="botones">
            <a href="act1triki.php?style=light" class="styleButton">Claro</a>
            <a href="act1triki.php?style=dark" class="styleButton">Oscuro</a>
        </div>
        <br>
        <div><a href="act1triki.php?delete_cookies=1">Borrar cookies</a></div>
</body>
</html>
