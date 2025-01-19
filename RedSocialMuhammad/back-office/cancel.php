<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/session.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/connection.inc.php');

// session para quien puede entrar en index
// $_SESSION['allow_index_access'] = true;

// session para quien puede entrar en new
// $_SESSION['allow_new_access'] = true;

// session para quien puede entrar en close y account
// $_SESSION['allow_closeAndAccount_access'] = true;

if (!isset($_SESSION['user_id'])) {
    header("Location: /front-end/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar_eliminacion'])) {
    $connection = new PDO($dsn, $user, $pass, $options);

    try {
        // Eliminar las relaciones de seguidores del usuario en la tabla 'follows'
        $query = $connection->prepare("DELETE FROM follows WHERE user_id = ?");
        $query->execute([$_SESSION['user_id']]);

        unset($query);

        // Eliminar dislikes del usuario
        $query = $connection->prepare("DELETE FROM dislikes WHERE user_id = ?");
        $query->execute([$_SESSION['user_id']]);

        unset($query);

        // Eliminar likes del usuario
        $query = $connection->prepare("DELETE FROM likes WHERE user_id = ?");
        $query->execute([$_SESSION['user_id']]);

        unset($query);

        // Eliminar comentarios del usuario
        $query = $connection->prepare("DELETE FROM comments WHERE user_id = ?");
        $query->execute([$_SESSION['user_id']]);

        unset($query);

        // Eliminar publicaciones del usuario
        $query = $connection->prepare("DELETE FROM entries WHERE user_id = ?");
        $query->execute([$_SESSION['user_id']]);

        unset($query);

        // Eliminar al usuario
        $query = $connection->prepare("DELETE FROM users WHERE id = ?");
        $query->execute([$_SESSION['user_id']]);

        // Cerrar la sesión
        session_destroy();
        unset($query);
        unset($connection);
        
        // Redirigir al index
        header("Location: /front-end/index.php");
        exit;
    } catch (Exception $e) {
        // Manejo de errores
        echo "Error al eliminar la cuenta: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Cuenta - Mi Red Social</title>
    <link rel="stylesheet" href="/styles/style.css?v=1.0">
    <!-- me da problemas de cache así que he tenido que añadir ?v=1.0 -->
</head>
<body class="red">
    <?php require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/header.inc.php'); ?> 
    <main>
        <?php if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['confirmar_eliminacion'])){ ?>
            <!-- Mostro formulario de confirmación si no se ha recibido el POST -->
            <a href="/back-office/account.php?id=">Account</a>
            
            <h2>Eliminar Cuenta</h2>
            <p>¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.</p>
            <form action="#" method="POST">
                <label for="confirmar_eliminacion">
                    <input type="checkbox" name="confirmar_eliminacion" id="confirmar_eliminacion" required>
                    Confirmo que deseo eliminar mi cuenta.
                </label>
                <br>
                <button type="submit">Confirmar Eliminación</button>
            </form>
        <?php }else{ ?>
            <!-- Si el checkbox está marcado, mostrar mensaje de confirmación -->
            <p>Tu cuenta ha sido eliminada con éxito.</p>
        <?php } ?>
    </main>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.inc.php'); ?>
</body>
</html>


