<?php
/**
 * Actividad para Login
 * 
 * @author Muhammad
 * @version 2.0
 */

require_once($_SERVER['DOCUMENT_ROOT'].'\includes\usersList.inc.php');

require_once($_SERVER['DOCUMENT_ROOT'].'\includes\User.inc.php');

$errors = [];
$userData = null;

if (!empty($_POST)) {
    $username = trim($_POST['user']);
    $password = trim($_POST['password']);

    // Verificamos si ambos campos están completos.
    if (empty($username)) {
        $errors['user'] = 'Por favor, completa el campo de Usuario.';
    } elseif (empty($password)) {
        $errors['password'] = 'Por favor, completa el campo de Contraseña.';
    } else {
        // Usamos la función userExists para verificar si el usuario existe.
        $userData = userExists($username, $users);

        if ($userData !== null) {
            // Si el usuario existe, intentamos el login.
            if ($userData->login($password)) {
                // Login exitoso.
                echo "<p>Login correcto</p>";
                echo "<p>" . $userData->__toString() . "</p>";
                echo '<a href="index.php">Volver</a>';
                exit;
            } else {
                $errors['password'] = 'Contraseña incorrecta.';
            }
        } else {
            $errors['user'] = 'Usuario no encontrado.';
        }
    }
}

foreach ($errors as $error){
    print_r($error);
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accede a la web</title>
</head>
<body>
    <form action="#" method="post">
        Usuario: <input type="text" name="user" value="<?=$_POST['user']??''?>">
        <br>
        Contraseña: <input type="text" name="password" value="<?=$_POST['password']??''?>">
        <br>
        <input type="submit" value="Acceder">
    </form>
</body>
</html>