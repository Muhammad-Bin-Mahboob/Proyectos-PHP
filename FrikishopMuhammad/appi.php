<?php
/**
 * @author Muhammad
 * "version 3.0
 *
 */
require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/env.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/connection.inc.php');
 try {
	if ($connection = getDBConnection(DB_NAME, DB_USERNAME, DB_PASSWORD)) {
		$query = 'SELECT * FROM products;';
		$products = $connection->query($query)->fetchAll(PDO::FETCH_OBJ);
	} else {
		throw new Exception('Error en la conexión a la BBDD');
	}
} catch (Exception $exception) {
	$dbError = true;
}
unset($query);
unset($connection);
// echo '<pre>';
//     var_dump($products);
// echo '</pre>';

//      var_dump($products);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($products);