<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/session.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/connection.inc.php');

// session para quien puede entrara en index
// $_SESSION['allow_index_access'] = true;

// session para quien puede entrara en close y account
// $_SESSION['allow_closeAndAccount_access'] = true;

// if (isset($_SESSION['allow_new_access']) && $_SESSION['allow_new_access'] === true) {
//     unset($_SESSION['allow_new_access']);
// } else {
//     header("Location: /front-end/login.php");
//     exit;
// }

if (!isset($_SESSION['user_id'])) {
    header("Location: /front-end/login.php");
    exit;
}

// Inicializa $messages como un arreglo vacío
$messages = [];

if ($_POST) {
    $contenido = $_POST['contenido'] ?? '';

    try {
        if (empty($contenido)) {
            $messages['connection'] = "Todos los campos son obligatorios.";
        }

        if (!empty($contenido)) {
            $connection = new PDO($dsn, $user, $pass, $options);

            // insertar la publicacion en entries
            
            $query = $connection->prepare("INSERT INTO entries (user_id, text, date) VALUES (?, ?, NOW())");
            $query->execute([$_SESSION['user_id'], $contenido]);

            unset($query);
            unset($connection);
            header("Location: /front-end/index.php");
            exit;
        }
    } catch (PDOException $ex) {
        $messages['connection'] = "Error al registrar el usuario: " . $ex->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Publicación</title>
</head>
<body>
    <?php 
    require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/header.inc.php'); 
    require_once($_SERVER['DOCUMENT_ROOT'].'/includes/listaDeUsuarios.inc.php'); 
    ?>
    <main>
        <a href="/back-office/account.php?id=">Account</a>
        <h2>Nueva Publicación</h2>
        <?php 
        if (!empty($messages)) {
            foreach ($messages as $message) {
                echo "<p>$message</p>";
            }
        }
        ?>
        <form action="#" method="POST">
            <label for="contenido">Contenido:</label>
            <textarea id="contenido" name="contenido"></textarea>
            <button type="submit">Publicar</button>
        </form>
    </main>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.inc.php'); ?>
</body>
</html>
