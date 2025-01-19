<?php
/**
 * 
 * @author Muhammad
 * @version 1.0
 */

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/session.inc.php');

// if (isset($_SESSION['allow_author_access']) && $_SESSION['allow_author_access'] === false) {
//     unset($_SESSION['allow_author_access']); 
//     header("Location: /front-end/login.php);
//     exit;
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author</title>
    <link rel="stylesheet" href="/styles/style.css">
</head>
<body>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/header.inc.php'); ?>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/listaDeUsuarios.inc.php'); ?>
    <main>
        <h3>Muhammad Bin Mahboob</h3>
        <img src="/images/foto.jpg" alt="foto" class="foto">
    </main>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.inc.php'); ?>
</body>
</html>