<?php
/**
 * @author Muhammad
 * @version 1.0
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/session.inc.php');
$messages = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = trim($value);
    }

    if (empty($_POST['usuario'])) {
        $messages['usuario'] = 'El usuario no puede estar en blanco.';
    }
    if (empty($_POST['password'])) {
        $messages['password'] = 'La contraseña no puede estar en blanco.';
    }

    if (!isset($messages['usuario']) && !isset($messages['password'])) {
        try {
            require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/connection.inc.php');
            $connection = new PDO($dsn, $user, $pass, $options);

            $query = $connection->prepare('SELECT id, user, password, email FROM users WHERE user = :user OR email = :mail;');
            $query->bindParam(':user', $_POST['usuario']);
            $query->bindParam(':mail', $_POST['usuario']);
            $query->execute();

            if ($query->rowCount() !== 1) {
                $messages['login'] = 'Error en el acceso.';
            } else {
                $userData = $query->fetch(PDO::FETCH_ASSOC);
                if (password_verify($_POST['password'], $userData['password'])) {
                    session_regenerate_id();
                    $_SESSION['user'] = $userData['user'];
                    $_SESSION['user_id'] = $userData['id'];

                    header('Location: /front-end/index.php');
                    exit;
                } else {
                    $messages['incorrect'] = 'Contraseña incorrecta.';
                }
            }
        } catch (Exception $e) {
            $messages['connection'] = 'Error en el acceso: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header.inc.php'); ?>

    <h2>Accede a la aplicación</h2>

    <?php
    if (!empty($messages)) {
        foreach ($messages as $message) {
            echo "<p>$message</p>";
        }
    }
    ?>

    <form action="#" method="POST">
        <label for="usuario">Usuario o correo electrónico:</label>
        <input type="text" id="usuario" name="usuario" placeholder="Usuario o email" value="<?= $_POST['usuario'] ?? ''; ?>">
        <br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" placeholder="Contraseña">
        <br>

        <button type="submit">Accede</button>
    </form>
</body>
</html>






