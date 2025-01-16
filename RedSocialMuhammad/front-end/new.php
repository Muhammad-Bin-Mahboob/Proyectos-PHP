<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/session.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/connection.inc.php');

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
            $query = $connection->prepare("INSERT INTO entries (user_id, text, date) VALUES (?, ?, NOW())");
            $query->execute([$_SESSION['user_id'], $contenido]);

            unset($query);
            unset($connection);
            header("Location: index.php");
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
    <?php require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/header.inc.php'); ?>
    <main>
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

