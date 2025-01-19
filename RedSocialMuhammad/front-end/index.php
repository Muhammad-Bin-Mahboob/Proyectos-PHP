<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/session.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/connection.inc.php');

// if (isset($_SESSION['allow_index_access']) && $_SESSION['allow_index_access'] === true) {
//     unset($_SESSION['allow_index_access']); 
// } else {
//     header("Location: /front-end/login.php");
//     exit;
// }

// session para quien puede entrara en close y account
// $_SESSION['allow_closeAndAccount_access'] = true;

// session para quien puede entrara en new
// $_SESSION['allow_new_access'] = true;

$messages = []; 
// Inicializar mensajes

if (!isset($_SESSION['user'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usuario = trim($_POST['usuario'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $email = trim($_POST['email'] ?? '');

        // Validaciones iniciales
        if (empty($usuario) || empty($password) || empty($email)) {
            $messages['emptyBlock'] = "Tienes que rellenar todos los campos.";
        } elseif (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
            $messages['email'] = "El correo electrónico no es válido.";
        } else {
            try {
                $connection = new PDO($dsn, $user, $pass, $options);

                // Verificar si ya existe el usuario o el correo
                $checkQuery = $connection->prepare("
                    SELECT COUNT(*) AS user_count 
                    FROM users 
                    WHERE user = :usuario OR email = :email
                ");
                $checkQuery->bindParam(':usuario', $usuario);
                $checkQuery->bindParam(':email', $email);
                $checkQuery->execute();

                $result = $checkQuery->fetch(PDO::FETCH_ASSOC);

                unset($checkQuery);

                if ($result['user_count'] > 0) {
                    // Comprobar cuál campo está duplicado
                    $userCheck = $connection->prepare("SELECT id FROM users WHERE user = :usuario");
                    $userCheck->bindParam(':usuario', $usuario);
                    $userCheck->execute();

                    if ($userCheck->rowCount() > 0) {
                        $messages['user'] = "Error: el usuario ya existe.";
                    }

                    $emailCheck = $connection->prepare("SELECT id FROM users WHERE email = :email");
                    $emailCheck->bindParam(':email', $email);
                    $emailCheck->execute();

                    if ($emailCheck->rowCount() > 0) {
                        $messages['email'] = "Error: el correo electrónico ya está registrado.";
                    }

                    unset($userCheck);
                    unset($emailCheck);

                    unset($connection);
                } else {
                    // Insertar usuario
                    $query = $connection->prepare("INSERT INTO users (user, password, email) VALUES (:usuario, :password, :email)");
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $query->bindParam(':usuario', $usuario);
                    $query->bindParam(':password', $hashedPassword);
                    $query->bindParam(':email', $email);
                    $query->execute();

                    unset($query);
                    unset($connection);

                    // Redirigir al inicio de sesión
                    header("Location: /front-end/login.php");
                    exit;
                }
            } catch (PDOException $ex) {
                $messages['connection'] = "Error al registrar el usuario: " . $ex->getMessage();
            }
        }
    }
} elseif (isset($_SESSION['user'])) {
    try {
        $connection = new PDO($dsn, $user, $pass, $options);

        // Consultar las publicaciones de los usuarios seguidos
        $query = $connection->prepare('
       SELECT e.id AS entry_id, e.text AS text, e.date AS date, u.id AS user_id, u.user AS username, u.email AS email,
        COUNT(DISTINCT c.id) AS total_comments, COUNT(DISTINCT l.user_id) AS total_likes, COUNT(DISTINCT d.user_id) AS total_dislikes
        FROM entries e
        LEFT JOIN users u ON e.user_id = u.id
        LEFT JOIN comments c ON e.id = c.entry_id
        LEFT JOIN likes l ON e.id = l.entry_id
        LEFT JOIN dislikes d ON e.id = d.entry_id
        LEFT JOIN follows f ON f.user_followed = e.user_id
        WHERE f.user_id = ' . $_SESSION['user_id'] . ' 
        AND e.user_id != ' . $_SESSION['user_id'] . '
        GROUP BY e.id
        ORDER BY e.date DESC
        ');
        
        $query->execute();

        $entries = $query->fetchAll(PDO::FETCH_ASSOC);

        unset($query);
        unset($connection);

        //var_dump($entries);
    } catch (PDOException $ex) {
        $messages['connection'] = "Error al obtener las publicaciones: " . $ex->getMessage();
    }
    
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Red Social</title>
    <link rel="stylesheet" href="/styles/style.css">
</head>
<body>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/header.inc.php'); ?>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/listaDeUsuarios.inc.php'); ?>
    <main>
    <a href="/back-office/account.php?id=">Account</a>
        <?php
        if (!isset($_SESSION['user'])) {
            echo '<h2>Bienvenido a Mi Red Social</h2>';
            echo '<p>Por favor, Regístrate</p>';

            foreach ($messages as $message) {
                echo '<p>' . $message . '</p>';
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
        } elseif (isset($_SESSION['user'])) {
            // Mostrar publicaciones
            echo '<h2>Bienvenido, ' . $_SESSION['user'] . '</h2>';
            echo '<p>Aquí verás publicaciones de usuarios a los que sigues.</p>';
            // Mostrar entries
            if ($entries) {
                foreach ($entries as $entry) {
                    echo '<div>';
                    echo '<h3><a href="/front-end/entry.php?id=' . $entry['entry_id'] . '">' . $entry['text'] . '</a></h3>';
                    echo '<p><a href="/front-end/user.php?id=' . $entry['user_id'] . '">' . $entry['username'] . '</a> - ' . $entry['date'] . '</p>';
                    
                    // Mostrar likes y dislikes
                    echo '<p>';
                        echo '<img src="/images/like.png" class="emoji" alt="Me gusta">';
                        echo $entry['total_likes'];
                    
                        echo '<img src="/images/dislike.webp" class="emoji" alt="No me gusta">';
                        echo $entry['total_dislikes'];
                    echo '</p>';
                    
                    // Mostrar número de comentarios
                    echo '<img src="/images/comment.avif" class="emoji" alt="comentario">';
                    echo '<p><a>Comentarios (' . $entry['total_comments'] . ')</a></p>';
                    echo '</div>';
                }
            } else {
                echo '<p>No hay publicaciones recientes de usuarios que sigues.</p>';
            }
        }
        ?>
    </main>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.inc.php'); ?>
</body>
</html>












