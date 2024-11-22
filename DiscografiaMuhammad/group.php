<?php
/**
 * Discografía
 *
 * @author Muhammad
 * @version 2.0
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/connection.inc.php');

if (!isset($_GET['id'])) {
    $_GET['id'] = null;
}

if (!isset($_GET['action'])) {
    $_GET['action'] = null;
}

if (!isset($_GET['album'])) {
    $_GET['album'] = null;
}

try {
    $connection = new PDO($dsn, $user, $pass, $options);

    // Consultar los álbumes del grupo
    $query = $connection->prepare('SELECT id, title, group_id, price, photo 
                                   FROM albums 
                                   WHERE group_id = :idOfGroup');
    $query->bindParam(':idOfGroup', $_GET['id']);
    $query->execute();
    $albums = $query->fetchAll(PDO::FETCH_OBJ);

    // Mensajes de confirmación y eliminación
    if ($_GET['action'] === 'confirm') {
        $messages['actionMessage'] = "¿Estás seguro de que deseas eliminar este álbum?";
        $messages['cancel'] = '<a href="group.php?id=' . $_GET['id'] . '">Cancelar</a>';
        $messages['confirm'] = '<a href="group.php?id=' . $_GET['id'] . '&album=' . $_GET['album'] . '&action=delete">Confirmar</a>';
    }

    if ($_GET['action'] === 'delete') {
        $deleteAlbum = $connection->prepare('DELETE FROM albums WHERE id = :album_id AND group_id = :group_id');
        $deleteAlbum->bindParam(':album_id', $_GET['album']);
        $deleteAlbum->bindParam(':group_id', $_GET['id']);
        $deleteAlbum->execute();
        $messages['success'] = 'Álbum eliminado correctamente.';
        
        header("Location: group.php?id=" . $_GET['id']);
    }

    if (!empty($_POST)) {
        // Validar los campos del formulario
        if (empty($_POST['album_name'])) {
            $messages['albumName'] = 'El nombre del álbum es obligatorio.';
        }
        if (empty($_POST['price']) || !preg_match('/^\d+(\.\d{2})$/', $_POST['price']) || $_POST['price'] <= 0) {
            $messages['price'] = 'El precio debe ser un número positivo, mayor que cero, con exactamente dos decimales.';
        }
        if ($_POST['group_id'] != $_GET['id']) {
            $messages['ID'] = 'El ID del grupo no coincide con el grupo actual.';
        }
        if (!in_array($_POST['format'], ['cd', 'vinilo', 'mp3', 'dvd'])) {
            $messages['Format'] = 'Solo permite formato cd, vinilo, mp3 o dvd.';
        }        
    
        // Si no hay errores, guardar el álbum en la base de datos
        if (empty($messages)) {
            $insertAlbum = $connection->prepare('
                INSERT INTO albums (title, group_id, year, format, buydate, price, photo) 
                VALUES (:title, :group_id, :year, :format, :buydate, :price, :photo)');
            $insertAlbum->bindParam(':title', $_POST['album_name']);
            $insertAlbum->bindParam(':group_id', $_POST['group_id']);
            $insertAlbum->bindParam(':year', $_POST['año']);
            $insertAlbum->bindParam(':format', $_POST['format']);
            $insertAlbum->bindParam(':buydate', $_POST['date']);
            $insertAlbum->bindParam(':price', $_POST['price']);
            $insertAlbum->bindParam(':photo', $_POST['photo']);
            $insertAlbum->execute();
            header("Location: group.php?id=" . $_POST['group_id']);
        } else {
            $messages['emptyPost']= 'Tienes que rellenar todos los campos.';
        }
    }

    unset($query, $connection);
} catch (PDOException $ex) {
    $messages['connection'] = 'Error en la conexión a la base de datos';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Discografía</title>
</head>
<body>
    <header>
        <a href="index.php"><b>Discografía</b></a>
        <a href="songs.php"><b>Canciones</b></a>
    </header>
    <h2>Álbumes del Grupo</h2>

    <?php
    // Muestro los errores
    if (!empty($messages)) {
        foreach ($messages as $key => $message) {
            echo "<p>".$message."</p>";
        }
    }
     
    // Muestrar los albums
    if (!empty($albums)) {
        foreach ($albums as $album) {
            echo '<div>';
            echo    '<h3>' . $album->title . '</h3>';
            echo    '<p>Precio: €' . $album->price . '</p>';
            echo    '<img src="/imagenes/albumes/' . $album->photo . '" alt="' . $album->title . '" class="size">';
            echo    '<div class="DustBin">
                        <a href="group.php?id=' . $_GET['id'] . '&album=' . $album->id . '&action=confirm">
                            <img src="/imagenes/papelera.png" alt="papelera">
                        </a>
                    </div>';
            echo '</div>';
        }
    } else {
        echo '<p>No hay álbumes registrados para este grupo.</p>';
    }
    ?>

    <h3>Añadir nuevo álbum</h3>
    <form action="#" method="post">
        <label for="album_name">Nombre del álbum:</label>
        <input type="text" name="album_name" id="album_name">

        <label for="año">Año de Lanzamiento:</label>
        <input type="number" name="año" id="año">

        <label for="date">Fecha de Lanzamiento:</label>
        <input type="date" name="date" id="date">

        <label for="price">Format(cd,vinilo,mp3,dvd):</label>
        <input type="text" name="format" id="format">

        <label for="price">Precio:</label>
        <input type="text" name="price" id="price">

        <label for="photo">Photo:</label>
        <input type="text" name="photo" id="photo">

        <input type="hidden" name="group_id" value="<?php echo $_GET['id']; ?>">

        <input type="submit" value="Añadir álbum">
    </form>

    <footer>
        <h3>Muhammad Bin Mahboob © 2024</h3>
    </footer>
</body>
</html>

