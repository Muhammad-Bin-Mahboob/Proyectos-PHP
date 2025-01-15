<?php
/**
 * 
 * @author Muhammad
 * @version 2.0
 */
?>
<header>
    <h1><a href="/">MerchaShop</a></h1>

    <a href="/">Principal</a>

    <?php if (!isset($_SESSION['user'])){ ?>
    <div id="zonausuario">
    <!-- Si el usuario no está logueado (no existe su variable de sesión): -->
        <span>¿Ya tienes cuenta? <a href="/login">Loguéate aquí</a>.</span>
    <!-- Fin usuario no logueado -->
    <?php } else {?>
    <!-- Si el usuario está logueado (existe su variable de sesión): -->
        <span id="usuario"><?= $_SESSION['user'] ?? ''?></span>
        <!-- Solo si el usuario es administrador -->
         <?php if($_SESSION['rol']=='admin'){
             echo '<a href="/users">Ver usuarios</a>';
         }
         ?>
        <br>
        <span id="logout"><a href="/logout">Desconectar</a></span>
    <!-- Fin usuario logueado -->
    </div>
    <?php } ?>
</header>