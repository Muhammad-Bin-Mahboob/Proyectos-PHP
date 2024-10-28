<?php
/**
 * Actividad para Login
 * 
 * @author Muhammad
 * @version 2.0
 */

require_once($_SERVER['DOCUMENT_ROOT'].'\includes\User.inc.php');

$users = [
    new User("HomerSimpson", "donuts", "homer@springfield.com"),
    new User("PeterGriffin", "freakinSweet", "peter@quahog.com"),
    new User("RickSanchez", "wubbalubbadubdub", "rick@multiverse.com"),
    new User("StanSmith", "CIAAgent", "stan@langley.com"),
    new User("BenderRodriguez", "bending", "bender@futurama.com"),
    new User("DariaMorgendorffer", "sarcastic", "daria@lawndale.com"),
    new User("Fry", "futurama123", "fry@futurama.com"),
    new User("LisaSimpson", "smartgirl", "lisa@springfield.com"),
    new User("MegGriffin", "loser", "meg@quahog.com"),
    new User("Cartman", "respectmyauthority", "cartman@southpark.com"),
];

function userExists(string $nombre, array $usuarios): mixed {
    foreach ($usuarios as $usuario) {
        // Si el username coincide con el nombre, devuelve el usuario.
        if ($usuario->username === $nombre) {
            return $usuario;
        }
    }
    // Si no se encuentra el usuario, devuelve null.
    return null;
}
