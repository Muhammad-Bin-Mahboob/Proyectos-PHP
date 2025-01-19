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

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: /front-end/index.php");
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
    unset($connection);

    if (!$publicacion) {
        echo "Publicación no encontrada.";
    }

    // Manejar "me gusta" o "no me gusta"
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accion'])) {
       
        $connection = new PDO($dsn, $user, $pass, $options);
       
        $accion = $_GET['accion'];
    
        $userId = $_SESSION['user_id'];

    
        // Comprobar si el usuario ya ha dado like o dislike
        $query = $connection->prepare("
            SELECT 
                (SELECT COUNT(*) FROM likes WHERE entry_id = ? AND user_id = ?) AS ya_like,
                (SELECT COUNT(*) FROM dislikes WHERE entry_id = ? AND user_id = ?) AS ya_dislike
        ");
        $query->execute([$id, $userId, $id, $userId]);
        $estado = $query->fetch(PDO::FETCH_ASSOC);

        unset($query);
    
        // Manejar las acciones
        if ($accion === 'like') {
            if ($estado['ya_dislike'] > 0) {
                // Eliminar dislike y agregar like
                $query = $connection->prepare("DELETE FROM dislikes WHERE entry_id = ? AND user_id = ?");
                $query->execute([$id, $userId]);

                unset($query);
                
                $query = $connection->prepare("INSERT INTO likes (entry_id, user_id) VALUES (?, ?)");
                $query->execute([$id, $userId]);
                
                unset($query);
            } elseif ($estado['ya_like'] === 0) {
                // Agregar like si no existe
                $query = $connection->prepare("INSERT INTO likes (entry_id, user_id) VALUES (?, ?)");
                $query->execute([$id, $userId]);

                unset($query);
            }

        } elseif ($accion === 'dislike') {
            if ($estado['ya_like'] > 0) {
                // Eliminar like y agregar dislike
                $query = $connection->prepare("DELETE FROM likes WHERE entry_id = ? AND user_id = ?");
                $query->execute([$id, $userId]);

                unset($query);
    
                $query = $connection->prepare("INSERT INTO dislikes (entry_id, user_id) VALUES (?, ?)");
                $query->execute([$id, $userId]);

                unset($query);
            } elseif ($estado['ya_dislike'] === 0) {
                // Agregar dislike si no existe
                $query = $connection->prepare("INSERT INTO dislikes (entry_id, user_id) VALUES (?, ?)");
                $query->execute([$id, $userId]);

                unset($query);
            }
        }

        unset($connection);
    
        header("Location: /front-end/entry.php?id=$id");
        exit;
    }
    
    try {
        $connection = new PDO($dsn, $user, $pass, $options);
        // Obtener comentarios
        $query = $connection->prepare("SELECT c.*, u.user AS autor FROM comments c JOIN users u ON c.user_id = u.id WHERE c.entry_id = ? ORDER BY c.date DESC");
        $query->execute([$id]);
        $comentarios = $query->fetchAll(PDO::FETCH_ASSOC);

        unset($query);
        unset($connection);
    } catch (PDOException $ex) {
        echo "Error de conexión";
    }
} catch (PDOException $ex) {
    echo "Error de conexión";
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
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/listaDeUsuarios.inc.php'); ?>
    <main>
    <a href="/back-office/account.php?id=">Account</a>
        <h2><?= $publicacion['text']; ?></h2>
        <p>Autor: <a href="/front-end/user.php?id=<?= $publicacion['user_id']; ?>"><?= $publicacion['usuario']; ?></a></p>
        <div>
            <a href="/front-end/entry.php?id=<?= $id; ?>&accion=like">
                <img src="/images/like.png" alt="Me gusta" title="Me gusta" class="emoji">
            </a>
            <span>(<?= $publicacion['likes']; ?>)</span>
            <a href="/front-end/entry.php?id=<?= $id; ?>&accion=dislike">
                <img src="/images/dislike.webp" alt="No me gusta" title="No me gusta" class="emoji">
            </a>
            <span>(<?= $publicacion['dislikes']; ?>)</span>
        </div>
        
        <h3><img src="/images/comment.avif" alt="comment" class="emoji">Comentarios</h3>
        
        <?php if ($comentarios){ ?>
            <?php foreach ($comentarios as $comentario){ ?>
                <p><strong><?= $comentario['autor']; ?>:</strong> <?= ($comentario['text']); ?></p>
            <?php } ?>
        <?php }else{ ?>
            <p>No hay comentarios todavía.</p>
        <?php } ?>

        <?php if (isset($_SESSION['user_id'])){ ?>
            <form action="/front-end/comment.php" method="POST">
                <input type="hidden" name="publicacion_id" value="<?= $id; ?>">
                <textarea name="comentario" ></textarea>
                <button type="submit">Comentar</button>
            </form>
        <?php } ?>
    </main>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.inc.php'); ?>
</body>
</html>
