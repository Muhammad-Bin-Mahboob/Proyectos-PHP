<?php
/**
* Discografía
*
* @author Muhammad
* @version 1.0
*/
$dsn = 'mysql:host=localhost;port=3306;dbname=discografia';
$user = 'vetustamorla';
$pass = '15151';
$options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];
$message = [];
$songs = [];

try {
    $connection = new PDO($dsn, $user, $pass, $options);

    // Validación de parámetros GET para 'field'
    if (isset($_GET['field'])) {
        $field = $_GET['field'];
        // Validar y asignar el campo adecuado
        if ($field === 'album') {
            $field = 'a.title';
        } elseif ($field === 'group') {
            $field = 'g.name';
        } elseif ($field === 'title' || $field === 'length') {
            $field = 's.' . $field;
        } else {
            $field = 's.title'; 
			// Valor por defecto si el parámetro no es válido
        }
    } else {
        $field = 's.title'; 
		// Valor por defecto si no se especifica 'field'
    }

    if (isset($_GET['order']) && ($_GET['order'] === 'desc' || $_GET['order'] === 'asc')) {
        $order = $_GET['order'];
    } else {
        $order = 'asc';
    }


    $query = $connection->prepare(
        'SELECT s.id, s.title, length, a.title AS album, g.name AS "group"
        FROM songs s, albums a, groups g
        WHERE album_id = a.id AND group_id = g.id
        ORDER BY ' . $field . ' ' . $order
    );

    $query->execute();
    $songs = $query->fetchAll(PDO::FETCH_OBJ);

    unset($query);
    unset($connection);

} catch (Exception $ex) {
    $message['connection'] = 'Fallo al crear la conexión.';
}
//var_dump($songs);

function formatDuration($seconds) {
    $minutes = (int)($seconds / 60);  // Obtener los minutos
    $seconds = $seconds - ($minutes * 60);  // Calcular los segundos restantes

    // Asegurarse de que los minutos y segundos tengan siempre 2 dígitos
    if ($minutes < 10) {
        $minutes = '0' . $minutes;
    }
    if ($seconds < 10) {
        $seconds = '0' . $seconds;
    }

    return $minutes . ':' . $seconds;
}

//var_dump($songs);
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/styles/style.css">
	<title>Discografía</title>
</head>

<body>
	<header>
		<a href="index.php"><b>Discografía</b></a>
		<a href="songs.php"><b>Canciones</b></a>
    </header>
	
	<h2>Canciones:</h2>

	<table>
        <thead>
            <tr>
                <th>Título
                    <a href="songs.php?field=title&order=asc"><img src="imagenes/sort-asc.png" alt="ascendiente"></a>
                    <a href="songs.php?field=title&order=desc"><img src="imagenes/sort-desc.png" alt="descendiente"></a>
                </th>
                <th>Duración
                    <a href="songs.php?field=length&order=asc"><img src="imagenes/sort-asc.png" alt="ascendiente"></a>
                    <a href="songs.php?field=length&order=desc"><img src="imagenes/sort-desc.png" alt="descendiente"></a>
                </th>
                <th>Álbum
                    <a href="songs.php?field=album&order=asc"><img src="imagenes/sort-asc.png" alt="ascendiente"></a>
                    <a href="songs.php?field=album&order=desc"><img src="imagenes/sort-desc.png" alt="descendiente"></a>
                </th>
                <th>Grupo
                    <a href="songs.php?field=group&order=asc"><img src="imagenes/sort-asc.png" alt="ascendiente"></a>
                    <a href="songs.php?field=group&order=desc"><img src="imagenes/sort-desc.png" alt="descendiente"></a>
                </th>
            </tr>
        </thead>
        <tbody>
			<?php foreach($songs as $song) { ?>
                <tr>
                    <td><?php echo $song->title; ?></td>
                    <td><?php echo formatDuration($song->length); ?></td>
                    <td><?php echo $song->album; ?></td>
                    <td><?php echo $song->group; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <footer>
		<h3>Muhammad Bin Mahboob © 2024</h3>
    </footer>
</html>