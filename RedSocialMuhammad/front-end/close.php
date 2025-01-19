<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/session.inc.php');

// if (isset($_SESSION['allow_closeAndAccount_access']) && $_SESSION['allow_closeAndAccount_access'] === true) {
//     unset($_SESSION['allow_closeAndAccount_access']); 
// } else {
//     header("Location: /front-end/login.php");
//     exit;
// }

session_destroy();
header('Location: /front-end/login.php');