<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/session.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/connection.inc.php');

if (!isset($_SESSION['user_id'])) {
    echo "<p>Debes estar logueado para ver esta sección.</p>";
} else {

$user_id = $_SESSION['user_id'];

try {
    $connection = new PDO($dsn, $user, $pass, $options);

    $followsQuery = $connection->prepare("SELECT u.id, u.user FROM users u 
                                          JOIN follows f ON u.id = f.user_followed 
                                          WHERE f.user_id = :user_id");
    $followsQuery->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $followsQuery->execute();
    $followedUsers = $followsQuery->fetchAll(PDO::FETCH_ASSOC);

    unset($followQuery);
    unset($connection);
} catch (PDOException $ex) {
    echo "Error de conexión.";
}

?>

<aside>
    <h3>Usuarios que sigues</h3>
    <ul>
        <?php
        if ($followedUsers) {
            foreach ($followedUsers as $user) {
                echo '<li><a href="/front-end/user.php?id=' . $user['id'] . '">' . htmlspecialchars($user['user']) . '</a></li>';
            }
        } else {
            echo '<li>No sigues a ningún usuario.</li>';
        }
        ?>
    </ul>
</aside>
<?php } ?>
