<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/session.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/connection.inc.php');

// session para quien puede entrara en index
// $_SESSION['allow_index_access'] = true;

// session para quien puede entrara en new
// $_SESSION['allow_new_access'] = true;

if (!isset($_SESSION['user_id'])) {
    header("Location: /front-end/login.php");
    exit;
}

$id = $_SESSION['user_id'];

if (!$id) {
    header("Location: /front-end/index.php");
    exit;
}

try {
    $connection = new PDO($dsn, $user, $pass, $options);

    // querry para obtener el usuario
    $query = $connection->prepare("SELECT * FROM users WHERE id =" . $id);
    $query->execute();
    $usuario = $query->fetch(PDO::FETCH_ASSOC);

    unset($query);
    unset($connection);

} catch (PDOException $ex) {
    echo "Error de conexión";
}

if (!$usuario) {
    echo "Usuario no encontrado.";
    header("Location: /front-end/index.php");
    exit;
}

try {
    $connection = new PDO($dsn, $user, $pass, $options);
    
    // querry para las publicacciones
    $publicacionesQuery = $connection->prepare("SELECT * FROM entries WHERE user_id = ? ORDER BY date DESC");
    $publicacionesQuery->execute([$id]);
    $publicaciones = $publicacionesQuery->fetchAll(PDO::FETCH_ASSOC);

    unset($publicacionesQuery);
    unset($connection);
} catch (PDOException $ex) {
    echo "Error de conexión";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de <?= $usuario['user']; ?> - Mi Red Social</title>
    <link rel="stylesheet" href="/styles/style.css?v=1.0">
    <!-- me da problemas de cache asi que he tenido que añadir ?v=1.0 -->
</head>
<body class="red">
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header.inc.php'); ?>
    <main>
        <h2>Perfil de <?= $usuario['user']; ?></h2>
        <p>Email: <?= $usuario['email']; ?></p>
        <h3>Publicaciones</h3>
        <?php 
        if (empty($publicaciones)) {
            echo '<p>No hay publicaciones.<p>';
        } else {
            foreach ($publicaciones as $publicacion) { 
                // Obtener la cantidad de likes y dislikes para cada publicación
                try {
                    $connection = new PDO($dsn, $user, $pass, $options);

                    $likesQuery = $connection->prepare("SELECT COUNT(*) FROM likes WHERE entry_id = :entry_id");
                    $likesQuery->bindParam(':entry_id', $publicacion['id']);
                    $likesQuery->execute();
                    $totalLikes = $likesQuery->fetchColumn();

                    unset($likesQuery);

                    $dislikesQuery = $connection->prepare("SELECT COUNT(*) FROM dislikes WHERE entry_id = :entry_id");
                    $dislikesQuery->bindParam(':entry_id', $publicacion['id']);
                    $dislikesQuery->execute();
                    $totalDislikes = $dislikesQuery->fetchColumn();

                    unset($dislikeQuery);
                    unset($connection);
                } catch (PDOException $ex) {
                    $totalLikes = $totalDislikes = 0;
                } 
            ?>
            <article>
                <h4>
                    <a href="/front-end/entry.php?id=<?= $publicacion['id']; ?>">
                        <?= substr($publicacion['text'], 0, 50); ?>...
                    </a>
                </h4>
                <img src="/images/like.png" class="emoji" alt="Me gusta">
                <p>Likes: <?= $totalLikes; ?></p>

                <img src="/images/dislike.webp" class="emoji" alt="Me gusta">
                <p>Dislikes: <?= $totalDislikes; ?></p>

                <!-- Formulario para eliminar publicación -->
                <form action="/back-office/delete.php ?>" method="POST">
                    <input type="hidden" name="delete_entry_id" value="<?= $publicacion['id']; ?>">
                    <button type="submit">Eliminar</button>
                </form>
            </article>
            <?php } 
        } ?>
    </main>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.inc.php'); ?>
</body>
</html>

