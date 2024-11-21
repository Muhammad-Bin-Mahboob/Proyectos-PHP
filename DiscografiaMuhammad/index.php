<?php
/**
* Discografía
*
* @author Muhammad
* @version 2.0
*/
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/connection.inc.php');
$message=[];
// Array para almacenar mensajes de error
try{	
	$connection = new PDO($dsn, $user, $pass, $options);

	if (isset($_POST['search']) && !empty(trim($_POST['search']))) {
		$query = $connection->prepare('SELECT id, name, photo FROM groups WHERE name LIKE :search ORDER BY name ASC;');
		// Agregar comodines (%) al término de búsqueda para usar en la consulta
		$searchParam = '%' . $_POST['search'] .'%';
		$query->bindParam(':search', $searchParam);
		$query->execute();

		$groups = $query->fetchAll(PDO::FETCH_OBJ);

		if (empty($groups)) {
            $message['search'] = 'No se encontraron grupos que coincidan con la búsqueda.';
        } else {
            $message['search'] = 'Se encontraron ' . count($groups) . ' grupos.';
        }
	} else {
		// Si no se realizó una búsqueda, mostrar todos los grupos
		$query = $connection->prepare('SELECT id, name, photo FROM groups ORDER BY name ASC;');
		$query->execute();
		$groups = $query->fetchAll(PDO::FETCH_OBJ);

		$message['search'] = 'Mostrando todos los grupos.';
	}
	// Liberar los recursos
	unset($query);
	// Cerrar la conexión
	unset($connection);

} catch(Exception $ex) {
	$message['connection'] = 'Fallo al crear la conexión.';
}
//var_dump($groups);
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/css/style.css">
	<title>Discografía</title>
</head>

<body>
	<header>
		<a href="index.php"><b>Discografía</b></a>
		<a href="songs.php"><b>Canciones</b></a>
    </header>

	<form action="#" method="post">
		<label for="search">Búsqueda</label>
		<input type="text" name="search" id="search">
		<input type="submit" value="Buscar">
	</form>
	
	<h2>Grupos:</h2>
	<?php
    if (!empty($message)) {
        if (isset($message['connection'])) {
            echo '<p>' . $message['connection'] . '</p>';
        } else if (isset($message['search'])) {
            echo '<p>' . $message['search'] . '</p>';
        }
    }

    if (!empty($groups)) {
        foreach ($groups as $group) {
            echo '<div class="group">';
            echo '<h3><a href="group.php?id=' . $group->id . '">' . $group->name . '</a></h3>';
            echo '<a href="group.php?id=' . $group->id . '">
					<img src="/imagenes/grupos/' . $group->photo . '" alt="' . $group->name . '" class="size">
				  </a>';
			echo '</div>';
        }
    }
    ?>
    <footer>
		<h3>Muhammad Bin Mahboob © 2024</h3>
    </footer>
</html>