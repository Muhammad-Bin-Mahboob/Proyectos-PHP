<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/session.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/connection.inc.php');

// session para quien puede entrara en index
// $_SESSION['allow_index_access'] = true;

// session para quien puede entrara en close y account
// $_SESSION['allow_closeAndAccount_access'] = true;

// session para quien puede entrara en new
// $_SESSION['allow_new_access'] = true;

if (!isset($_SESSION['user_id'])) {
    header("Location: /front-end/login.php");
    exit;
}

$busqueda = $_GET['busqueda'] ?? '';

if ($busqueda) {
    try {
        $connection = new PDO($dsn, $user, $pass, $options);

        $query = $connection->prepare("SELECT id, user FROM users WHERE user LIKE ? AND id != ?");
        $query->execute(['%' . $busqueda . '%', $_SESSION['user_id']]);
        $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

        // Verificar si el usuario actual ya sigue a cada uno de los resultados
        $seguimientos = [];
        $query_follow = $connection->prepare("SELECT user_followed FROM follows WHERE user_id = ?");
        $query_follow->execute([$_SESSION['user_id']]);
        $seguimientos = $query_follow->fetchAll(PDO::FETCH_COLUMN);

        unset($query);
        unset($query_follow);
        unset($connection);
    } catch (PDOException $ex) {
        echo "Error de conexión";
    }
} else {
    $usuarios = [];
    $seguimientos = [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Búsqueda - Mi Red Social</title>
</head>
<body>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/header.inc.php'); ?>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/listaDeUsuarios.inc.php'); ?>
    <main>
        <a href="/back-office/account.php?id=">Account</a>
        <h2>Resultados de Búsqueda</h2>
        <?php if ($busqueda){ ?>
            <p>Resultados para: <strong><?= $busqueda; ?></strong></p>
            <?php if ($usuarios){ ?>
                <ul>
                    <?php foreach ($usuarios as $usuario){ ?>
                        <li>
                            <a href="/front-end/user.php?id=<?= $usuario['id']; ?>"><?= $usuario['user']; ?></a>
                            <?php 
                            // Verificar si el usuario actual sigue a este usuario
                            if (in_array($usuario['id'], $seguimientos)) {
                                echo '<a href="/back-office/dejar_de_seguir.php?id=' . $usuario['id'] . '&busqueda='.$busqueda.'">Dejar de seguir</a>';
                            } else {
                                echo '<a href="/back-office/seguir.php?id=' . $usuario['id'] . '&busqueda='.$busqueda.'">Seguir</a>';
                            }
                            ?>
                        </li>
                    <?php } ?>
                </ul>
            <?php } else { ?>
                <p>No se encontraron usuarios.</p>
            <?php } ?>
        <?php } else { ?>
            <p>No ingresaste ningún término de búsqueda.</p>
        <?php } ?>
    </main>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.inc.php'); ?>
</body>
</html>

