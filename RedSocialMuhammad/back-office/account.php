<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/session.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/connection.inc.php');

// He utilizado este código para controlar la navegación, 
// es decir, para gestionar a qué páginas se puede acceder. 
// Lo comenté porque, al tenerlo activado en la página, los querries
// dejaron de funcionar, y no se porque.

// $_SESSION['allow_index_access'] = true;
// $_SESSION['allow_new_access'] = true;
// if (isset($_SESSION['allow_closeAndAccount_access']) && $_SESSION['allow_closeAndAccount_access'] === true) {
//     unset($_SESSION['allow_closeAndAccount_access']); 
// } else {
//     header("Location: /front-end/login.php");
//     exit;
// }


// si no exista el id de usuario te manda a login
if (!isset($_SESSION['user_id'])) {
    header("Location: /front-end/login.php");
    exit;
}

// comproba que ha llegado post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // con el trim quito espacios para luego no usarlo si es empty
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    try {
        $connection = new PDO($dsn, $user, $pass, $options);

        // hago las quierries para los campos que no son empty
        if (!empty($password)) {
            // Actualizar solo la contraseña
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = $connection->prepare("UPDATE users SET password = :password WHERE id = :id");
            $query->execute([
                ':password' => $hashedPassword,
                ':id' => $_SESSION['user_id']
            ]);
            $mensaje = "Contraseña actualizada correctamente.";

            unset($query);
        } 
        
        if (!empty($email)) {
            // Actualizar solo el email
            $query = $connection->prepare("UPDATE users SET email = :email WHERE id = :id");
            $query->execute([
                ':email' => $email,
                ':id' => $_SESSION['user_id']
            ]);
            $mensaje = "Correo electrónico actualizado correctamente.";

            unset($query);
        } 
        
        if (!empty($username)) {
            // Actualizar solo el nombre de usuario
            $query = $connection->prepare("UPDATE users SET user = :username WHERE id = :id");
            $query->execute([
                ':username' => $username,
                ':id' => $_SESSION['user_id']
            ]);
            $_SESSION['user'] = $username; 
            // Actualizar la sesión con el nuevo nombre de usuario
            $mensaje = "Nombre de usuario actualizado correctamente.";

            unset($query);
        }
        unset($connection);
    } catch (PDOException $e) {
        $error = "Error al actualizar los datos. Por favor, inténtelo de nuevo.";
    }
}

try {
    $connection = new PDO($dsn, $user, $pass, $options);

    // esta querry para selecionar el usuario

    $query = $connection->prepare("SELECT * FROM users WHERE id = :id");
    $query->execute([':id' => $_SESSION['user_id']]);
    $usuario = $query->fetch(PDO::FETCH_ASSOC);
    
    unset($query);
    unset($connection);
} catch (PDOException $e) {
    echo "Error al cargar los datos del usuario.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Cuenta - Mi Red Social</title>
    <link rel="stylesheet" href="/styles/style.css?v=1.0">
    <!-- me da problemas de cache asi que he tenido que añadir ?v=1.0 -->
</head>
<body class="red">
    <?php require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/header.inc.php'); ?> 
    <main class="red">
        <h2>Mi Cuenta</h2>
        <?php if (isset($mensaje)){
            echo '<p>'.$mensaje.'</p>';
        } elseif (isset($error)){
            echo '<p>'.$error.'</p>';
        } 
        
        // aqui mostrar la informacion de usuario que son (user, password, email)
        if (isset($usuario)) {
            echo "<h3>Información de tu cuenta:</h3>";
            echo "<p><strong>Usuario:</strong> " . $usuario['user'] . "</p>";
            echo "<p><strong>Email:</strong> " . $usuario['email'] . "</p>";
            echo "<p><strong>Contraseña:</strong> (no se muestra por seguridad)</p>";
        }
        ?>
        <!-- el usuario va escribir en el campo que quiere cambiar -->
        <form action="#" method="POST">
            <label for="username">Nuevo Nombre de Usuario (opcional):</label>
            <input type="text" id="username" name="username"><br>
           
            <label for="email">Nuevo Correo Electrónico (opcional):</label>
            <input type="email" id="email" name="email"><br>
            
            <label for="password">Nueva Contraseña (opcional):</label>
            <input type="text" id="password" name="password"><br>
            <button type="submit">Actualizar</button>
        </form>
        <a href="/back-office/list.php">List</a> | <a href="/back-office/cancel.php">Cancel</a>
    </main>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.inc.php'); ?>
</body>
</html>

