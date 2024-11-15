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
$message=[];
// Array para almacenar mensajes de error o de éxito
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
	<link rel="stylesheet" href="/styles/style.css">
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
            echo '<h3>' . $group->name . '</h3>';
            echo '<img src="/imagenes/grupos/' . $group->photo . '" alt="' . $group->name . '" width="150">';
            echo '</div>';
        }
    }
    ?>
    <footer>
		<h3>Muhammad Bin Mahboob © 2024</h3>
    </footer>
</html>