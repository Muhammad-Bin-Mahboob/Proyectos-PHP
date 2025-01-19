<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/session.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/connection.inc.php');

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: /front-end/login.php");
    exit;
}

$error = ''; // Variable para almacenar mensajes de error

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $publicacion_id = $_POST['publicacion_id'] ?? null;
    $comentario = trim($_POST['comentario'] ?? ''); 
    // Trim para eliminar espacios

    // Validar los datos
    if (!$publicacion_id || $comentario === '') {
        $error = "Error: El comentario no puede estar vacío o faltan datos.";
    } else {
        try {
            $connection = new PDO($dsn, $user, $pass, $options);

            // Insertar el comentario
            $query = $connection->prepare("
                INSERT INTO comments (entry_id, user_id, text, date)
                VALUES (?, ?, ?, NOW())
            ");
            $query->execute([$publicacion_id, $_SESSION['user_id'], $comentario]);

            unset($query);
            unset($connection);

            // Redirigir a la página de la publicación
            header("Location: /front-end/entry.php?id=$publicacion_id");
            exit;
        } catch (PDOException $ex) {
            $error = "Error al guardar el comentario: ";
        }
    }
}

// Si hay un error, mostrarlo en la página de la publicación
if ($error) {
    echo "<p>$error</p>";
    echo "<a href='/front-end/entry.php?id=$publicacion_id'>Volver a la publicación</a>";
    exit;
}
?>

