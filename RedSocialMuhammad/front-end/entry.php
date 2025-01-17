<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/session.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/connection.inc.php');

$id = $_GET['entry_id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit;
}

try {
    $connection = new PDO($dsn, $user, $pass, $options);

    // Obtener la publicación
    $query = $connection->prepare("SELECT p.*, u.user AS usuario,
        (SELECT COUNT(*) FROM likes WHERE entry_id = p.id) AS likes,
        (SELECT COUNT(*) FROM dislikes WHERE entry_id = p.id) AS dislikes
        FROM entries p
        JOIN users u ON p.user_id = u.id
        WHERE p.id =" . $id);
    $query->execute();
    $publicacion = $query->fetch(PDO::FETCH_ASSOC);

    unset($query);

    if (!$publicacion) {
        echo "Publicación no encontrada.";
    }

    // Manejar "me gusta" o "no me gusta"
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accion'])) {
        $accion = $_GET['accion'];
        $connection = new PDO($dsn, $user, $pass, $options);
        if ($accion === 'like') {
            $query = $connection->prepare("UPDATE entries SET likes = likes + 1 WHERE id = ?");
            $query->execute([$id]);
        } elseif ($accion === 'dislike') {
            $query = $connection->prepare("UPDATE entries SET dislikes = dislikes + 1 WHERE id = ?");
            $query->execute([$id]);
        }
        unset($query);
        unset($connection);
        header("Location: /front-end/entry.php?entry_id=$id");
        exit;
    }

    $connection = new PDO($dsn, $user, $pass, $options);
    // Obtener comentarios
    $query = $connection->prepare("SELECT c.*, u.user AS autor FROM comments c JOIN users u ON c.user_id = u.id WHERE c.entry_id = ? ORDER BY c.date DESC");
    $query->execute([$id]);
    $comentarios = $query->fetchAll(PDO::FETCH_ASSOC);

    unset($query);
    unset($connection);

} catch (PDOException $ex) {
    echo "Error de conexión: " . $ex->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $publicacion['text']; ?> - Mi Red Social</title>
</head>
<body>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header.inc.php'); ?>
    <main>
        <h2><?= $publicacion['text']; ?></h2>
        <p>Autor: <a href="/front-end/user.php?entry_id=<?= $publicacion['user_id']; ?>"><?= $publicacion['usuario']; ?></a></p>
        <div>
            <a href="/front-end/entry.php?entry_id=<?= $id; ?>&accion=like">
                <img src="/images/like.png" alt="Me gusta" title="Me gusta" class="emoji">
            </a>
            <span>(<?= $publicacion['likes']; ?>)</span>
            <a href="/front-end/entry.php?entry_id=<?= $id; ?>&accion=dislike">
                <img src="/images/dislike.webp" alt="No me gusta" title="No me gusta" class="emoji">
            </a>
            <span>(<?= $publicacion['dislikes']; ?>)</span>
        </div>
        
        <h3><img src="\images\comment.avif" alt="comment" class="emoji">Comentarios</h3>
        
        <?php if ($comentarios){ ?>
            <?php foreach ($comentarios as $comentario){ ?>
                <p><strong><?= $comentario['autor']; ?>:</strong> <?= ($comentario['text']); ?></p>
            <?php } ?>
        <?php }else{ ?>
            <p>No hay comentarios todavía.</p>
        <?php } ?>

        <?php if (isset($_SESSION['user'])){ ?>
            <form action="comment.php" method="POST">
                <input type="hidden" name="entry_id" value="<?= $id; ?>">
                <textarea name="text" required></textarea>
                <button type="submit">Comentar</button>
            </form>
        <?php } ?>
    </main>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.inc.php'); ?>
</body>
</html>

