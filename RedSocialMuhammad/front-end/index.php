<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/session.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/connection.inc.php');

$messages = []; // Inicializar mensajes

if (!isset($_SESSION['usuario'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usuario = trim($_POST['usuario'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $email = trim($_POST['email'] ?? '');

        // Validaciones
        if (empty($usuario) || empty($password) || empty($email)) {
            $messages['emptyBlock'] = "Tienes que rellenar todos los campos.";
        } elseif (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
            $messages['email'] = "El correo electrónico no es válido.";
        } else {
            try {
                $connection = new PDO($dsn, $user, $pass, $options);

                // Insertar usuario
                $query = $connection->prepare("INSERT INTO users (user, password, email) VALUES (:usuario, :password, :email)");
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $query->bindParam(':usuario', $usuario);
                $query->bindParam(':password', $hashedPassword);
                $query->bindParam(':email', $email);
                $query->execute();

                unset($query);
                unset($connection);

                // Redirigir al inicio de sesión o index
                header("Location: /front-end/login.php");
                exit;
            } catch (PDOException $ex) {
                $messages['connection'] = "Error al registrar el usuario: " . $ex->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Red Social</title>
</head>
<body>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/header.inc.php'); ?>
    <main>
        <?php
        if (!isset($_SESSION['usuario'])) {
            echo '<h2>Bienvenido a Mi Red Social</h2>';
            echo '<p>Por favor, Regístrate</p>';

            foreach ($messages as $message) {
                echo "<p>$message</p>";
            }
        ?>
        <form action="#" method="POST">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario"><br>
            <label for="email">Correo Electrónico:</label>
            <input type="text" id="email" name="email"><br>
            <label for="password">Contraseña:</label>
            <input type="text" id="password" name="password"><br>
            <button type="submit">Registrar</button>
        </form>
        <?php
        } else {
            echo '<h2>Bienvenido, ' . $_SESSION['usuario'] . '</h2>';
            echo '<p>Aquí verás publicaciones de usuarios a los que sigues.</p>';
        } ?>
    </main>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.inc.php'); ?>
</body>
</html>

