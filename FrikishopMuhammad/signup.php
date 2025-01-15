<?php
/**
 * 
 * @author Muhammad
 * @version 2.0
 */
require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/session.inc.php');

if(!empty($_POST)) {
    // Se eliminan los espacios delante y detrás de los campos recibidos
    foreach($_POST as $key => $value)
        $_POST[$key] = trim($value);

    // Si el campo está vacío se añade un elemento al array $errors[]
    if (empty($_POST['user']))
        $errors['user'] = 'El usuario no puede estar en blanco.';   
    if (empty($_POST['email']))
        $errors['email'] = 'El email no puede estar en blanco.';
    if (empty($_POST['password']))
        $errors['password'] = 'La contraseña no puede estar en blanco.';

    // Si no existe el array $errors[] es que todos los campos recibidos están bien
    if (!isset($errors)) {
        require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/env.inc.php');
        require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/connection.inc.php');
        try {
            if ($connection = getDBConnection(DB_NAME, DB_USERNAME, DB_PASSWORD)) {
                // Se comprueba que no exista ya en la BBDD un usuario con el username o el mail recibido
                $query = $connection->prepare('SELECT COUNT(*) AS total FROM users WHERE user = :user OR email = :mail');
                $query->bindParam(':user', $_POST['user']);
                $query->bindParam(':mail', $_POST['email']);
                $query->execute();

                // Obtener el resultado como un array asociativo
                $userData = $query->fetch(PDO::FETCH_ASSOC);

                if ($userData['total'] > 0) {   
                    // Si ya existe el usuario o correo, mostramos un error
                    $errors['login'] = 'Error: Intentalo mas tarde.';
                    // echo '<pre>';
                    // var_dump($query->debugDumpParams());
                    // echo '</pre>';
                } else {
                    // Si no existen, guardamos los datos del nuevo usuario
                    $query = $connection->prepare('INSERT INTO users (user, email, password) 
                                                VALUES (:user, :mail, :pass)');
                    $query->bindParam(':user', $_POST['user']);
                    $query->bindParam(':mail', $_POST['email']);
                    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $query->bindParam(':pass', $hashedPassword);
                    $query->execute();

                    // echo '<pre>';
                    // var_dump($query->debugDumpParams());
                    // echo '</pre>';

                    // Limpieza y redirección
                    unset($query);
                    unset($connection);
                    // Redirigir al formulario de login
                    header('Location: /login/signup/1');
                    exit;
                }
                unset($query);
                unset($connection);
            } else {
                throw new Exception('Error en la conexión a la BBDD');
            }
        } catch (Exception $exception) {
            $dbError = true;
            // echo '<pre>' ;
            // var_dump($exception);
            // echo '</pre>';
        } 
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MerchaShop - Error en el registro</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <?php
        require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/header.inc.php');
    ?>
    <div>
        <?php 
        if(isset($errors)){           
            echo '<h2>Existen errores en el formulario:</h2>';
            foreach ($errors as $value) {
                echo $value .'<br>';
            }
            echo '</div>';
        echo '<br>';
            echo '<a href="/">Vuelve a intentar el registro</a>';
        }
        ?>
    
</body>
</html>
