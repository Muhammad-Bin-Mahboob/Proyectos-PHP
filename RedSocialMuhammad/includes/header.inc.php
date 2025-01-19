<header>
    <img src="/images/twitterLogo.jpg" alt="logo" class="logo">
    <h1><a href="/front-end/index.php">Twitter</a></h1>
    <link rel="stylesheet" href="/styles/style.css">

    <?php
        if (isset($_SESSION['user_id'])) {
            echo '<form action="results.php" method="GET">
                      <input type="text" name="busqueda" placeholder="Buscar usuarios">
                      <button type="submit">Buscar</button>
                  </form>';
            echo '<nav>';
                      echo '<a href="/front-end/user.php?id=' . $_SESSION['user_id'] . '">' . $_SESSION['user'] . '</a><br>';
                      echo '<a href="/front-end/new.php">Nueva publicación</a><br>
                      <a href="/front-end/close.php">Cerrar sesión</a>
                  </nav>';
        } else {
            echo '<nav>
                      <a href="login.php">Iniciar sesión</a>
                  </nav>';
        }
    ?>
</header>