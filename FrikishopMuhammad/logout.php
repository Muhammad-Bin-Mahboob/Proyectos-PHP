<?php
/**
 * 
 * @author Muhammad
 * @version 2.0
 */
require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/session.inc.php');

// Se tiene que cerrar la sesión
// if(isset($_SESSION['user'])){
//     unset($_SESSION['user']);
//     unset($_SESSION['rol']);
// }
// if(isset($_SESSION['cart'])){
//     unset($_SESSION['cart']);
// }

session_destroy();
session_regenerate_id();
// Una vez cerrada la sesión se redirige a index
header ('location: /');
