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
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user'])) {
        $username = trim($_POST['user']);
    } else {
        $username = '';
    }
    
    if (isset($_POST['password'])) {
        $password = trim($_POST['password']);
    } else {
        $password = '';
    }    
 
    // Validar que ambos campos estén completos.
    if (empty($username)) {
        $errors['user'] = 'Por favor, completa el campo de Usuario.';
    } elseif (empty($password)) {
        $errors['password'] = 'Por favor, completa el campo de Contraseña.';
    } else {
        // Verificar si el usuario existe.
        $userData = userExists($username, $users);
 
        if ($userData !== null) {
            // Intentar el login.
            if ($userData->login($password)) {
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
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accede a la web</title>
</head>
<body>
    <?php 
        $fields = ['user', 'password'];
        foreach ($fields as $field) {
            if (isset($errors[$field])) {
                echo $errors[$field];
            }
        }
    ?>
    <br>
    <form action="#" method="post">
        Usuario: <input type="text" name="user" value="<?=$_POST['user']??''?>">
        <br>
        Contraseña: <input type="text" name="password" value="<?=$_POST['password']??''?>">
        <br>
        <input type="submit" value="Acceder">
    </form>
</body>
</html>