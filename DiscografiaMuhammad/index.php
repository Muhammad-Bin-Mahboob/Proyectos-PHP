<?php
/**
* Discografía
*
* @author Muhammad
* @version 1.0
*/

$dsn = 'mysql:host=localhost;port=3307;dbname=discografia';
$user = 'vetustamorla';
$pass = '15151';
$options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];

try{	
	$connection = new PDO($dsn, $user, $pass, $options);
} catch(Exception $ex) {
	echo 'Fallo al crear la conexión:' . $ex->getMessage();
}

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
	
    <footer>
		<h3>Muhammad Bin Mahboob © 2024</h3>
    </footer>
</html>

<!-- 
index.php:
En la parte superior tendrá un formulario con un campo de búsqueda. Este formulario debe enviar los datos al propio script index.php.
- Si el script no recibe datos del formulario deberá mostrar todos los grupos en orden alfabético ascendente.
SELECT id, name, photo FROM groups ORDERBY name ASC;
- Si el script recibe datos del formulario deberá mostrar de los grupos que contengan la palabra introducida en el campo de búsqueda: la cantidad de grupos y los grupos en orden alfabético ascendente. Si la búsqueda no devuelve resultados se mostrará un mensaje indicándolo. 
SELECT id, name, photo FROM groups WHERE name LIKE '%busqueda%' ORDERBY name ASC;
Cuando se muestren los grupos, de cada grupo se mostrará el nombre y su foto (obteniendo estos datos de la tabla groups).

// Asignación del término de búsqueda con if y uso de POST
if (isset($_POST['search']) && !empty(trim($_POST['search']))) {
    $searchTerm = trim($_POST['search']);
    $query = "SELECT id, name, photo FROM groups WHERE name LIKE :search ORDER BY name ASC";
    $stmt = $connection->prepare($query);
    $stmt->execute([':search' => "%$searchTerm%"]);
} else {
    $searchTerm = '';
    $query = "SELECT id, name, photo FROM groups ORDER BY name ASC";
    $stmt = $connection->prepare($query);
    $stmt->execute();
}
-->