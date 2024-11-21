<?php
/**
* Discografía
*
* @author Muhammad
* @version 2.0
*/

if (isset($_GET['id'])) {
    $groupId = $_GET['id'];
}

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/connection.inc.php');

$albums = [];
$messages = [];

try {
    $connection = new PDO($dsn, $user, $pass, $options);

    // Consultar los álbumes del grupo mandado por grupo.php
    $query = $connection->prepare('SELECT a.id, a.title, a.price, a.photo FROM albums a
                                    INNER JOIN groups g ON a.group_id = g.id
                                     WHERE g.id = :group_id');
    $query->bindParam(':group_id', $groupId);
    $query->execute();

    $albums = $query->fetchAll(PDO::FETCH_OBJ);

    unset($query);
    unset($connection);
} catch (Exception $ex) {
    $messages['connection'] = 'Error en la conexión a la base de datos.';
}

?>
<!DOCTYPE html>
<html lang="en">
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
    if (!empty($messages)) {
        if (isset($messages['connection'])) {
            echo '<p>' . $messages['connection'] . '</p>';
        }
    }
    
    if (!empty($albums)) {
        foreach ($albums as $album) {
            echo '<div>';
            echo '<h3>' . $album->title . '</h3>';
            echo '<p>Precio: €' . $album->price . '</p>';
            echo '<img src="/imagenes/albumes/' . $album->photo . '" alt="' . $album->title . '" class="size">';
            echo '<div class="DustBin">
                    <a href="grupo.php?id='. $album->group_id .'&album='.$album->id.'&acction=confirm">
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
    <form action="group.php?id=<?php echo $groupId; ?>" method="post">
        <label for="album_name">Nombre del álbum:</label>
        <input type="text" name="album_name" id="album_name"><br>
        
        <label for="price">Precio:</label>
        <input type="text" name="price" id="price"><br>
        
        <input type="hidden" name="group_id" value="<?php echo $groupId; ?>">
        
        <input type="submit" value="Añadir álbum">
    </form>

    <footer>
        <h3>Muhammad Bin Mahboob © 2024</h3>
    </footer>
</body>
</html>
