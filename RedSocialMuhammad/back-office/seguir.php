<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/session.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/connection.inc.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: /front-end/login.php");
    exit;
}

// en el pdf no ponia nada de seguir y dejar de seguir a los usuario
// y donde se tien que hacer

$usuario_id = $_GET['id'] ?? null;

if ($usuario_id) {
    try {
        $connection = new PDO($dsn, $user, $pass, $options);

        // Insertar en la tabla 'follows' para seguir al usuario
        $query = $connection->prepare("INSERT INTO follows (user_id, user_followed) VALUES (?, ?)");
        $query->execute([$_SESSION['user_id'], $usuario_id]);

        unset($query);
        unset($connection);

        // Redirigir de vuelta a la página de resultados de búsqueda
        header("Location: /front-end/results.php?busqueda=" . $_GET['busqueda']);
        exit;
    } catch (PDOException $ex) {
        echo "Error de conexión";
    }
} else {
    header("Location: /front-end/results.php");
    exit;
}
?>
