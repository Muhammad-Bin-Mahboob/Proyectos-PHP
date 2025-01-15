<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Red Social</title>
</head>
<body>
    <header>
        <h1><a href="index.php">Mi Red Social</a></h1>
        <?php
        session_start();
        if (isset($_SESSION['usuario'])) {
            echo '<form action="results.php" method="GET">
                      <input type="text" name="busqueda" placeholder="Buscar usuarios">
                      <button type="submit">Buscar</button>
                  </form>';
            echo '<nav>
                      <a href="account.php">' . $_SESSION['usuario'] . '</a>
                      <a href="new.php">Nueva publicación</a>
                      <a href="close.php">Cerrar sesión</a>
                  </nav>';
        } else {
            echo '<nav>
                      <a href="login.php">Iniciar sesión</a>
                      <a href="register.php">Registrarse</a>
                  </nav>';
        }
        ?>
    </header>
    <main>
        <?php
        if (isset($_SESSION['usuario'])) {
            echo '<h2>Bienvenido, ' . $_SESSION['usuario'] . '</h2>';
            echo '<p>Aquí verás publicaciones de usuarios a los que sigues.</p>';
            // Código para mostrar publicaciones
        } else {
            echo '<h2>Bienvenido a Mi Red Social</h2>';
            echo '<p>Por favor, <a href="register.php">regístrate</a> o <a href="login.php">inicia sesión</a>.</p>';
        }
        ?>
    </main>
    <footer>
        <p>Álex Torres © 2024-25</p>
        <p><a href="autor.php">Autor</a></p>
    </footer>
</body>
</html>
