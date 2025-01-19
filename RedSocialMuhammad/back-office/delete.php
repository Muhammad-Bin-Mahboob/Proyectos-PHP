<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/session.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/connection.inc.php');

// session para quien puede entrara en author
// $_SESSION['allow_author_access'] = false;

if (!isset($_SESSION['user_id'])) {
    header("Location: /front-end/login.php");
    exit;
}

$id = $_SESSION['user_id'];

var_dump($_POST['delete_entry_id']);

if (isset($_POST['delete_entry_id'])) {
    try {
        $connection = new PDO($dsn, $user, $pass, $options);

        // Eliminar comentarios de la entrada
        $deleteCommentsQuery = $connection->prepare("DELETE FROM comments WHERE entry_id = :entry_id");
        $deleteCommentsQuery->execute([':entry_id' => $_POST['delete_entry_id']]);

        // Eliminar likes de la entrada
        $deleteLikesQuery = $connection->prepare("DELETE FROM likes WHERE entry_id = :entry_id");
        $deleteLikesQuery->execute([':entry_id' => $_POST['delete_entry_id']]);

        // Eliminar dislikes de la entrada
        $deleteDislikesQuery = $connection->prepare("DELETE FROM dislikes WHERE entry_id = :entry_id");
        $deleteDislikesQuery->execute([':entry_id' => $_POST['delete_entry_id']]);

        // Eliminar la entrada
        $deleteEntryQuery = $connection->prepare("DELETE FROM entries WHERE id = :entry_id AND user_id = :user_id");
        $deleteEntryQuery->execute([
            ':entry_id' => $_POST['delete_entry_id'],
            ':user_id' => $id
        ]);

        unset($deleteCommentsQuery);
        unset($deleteLikesQuery);
        unset($deleteDislikesQuery);
        unset($deleteEntryQuery);
        unset($connection);

        // Redirigir a la página de listado
        header("Location: /back-office/list.php");
        exit;
    } catch (PDOException $ex) {
        echo "Error al eliminar la publicación y sus datos relacionados.";
    }
} else {
    header("Location: /back-office/list.php");
    exit;
}
?>