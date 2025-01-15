<header>
    <img src="/images/twitterLogo.jpg" alt="logo" class="logo">
    <h1><a href="/front-end/index.php">Twitter</a></h1>
    <link rel="stylesheet" href="/styles/style.css">

    <?php
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
                  </nav>';
        }
    ?>
</header>
