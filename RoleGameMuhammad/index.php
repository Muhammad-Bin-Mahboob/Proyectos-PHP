<?php
/**
 * @author Muhammad
 * @version 1.0
 */

// Incluir las clases necesarias
require_once($_SERVER['DOCUMENT_ROOT'].'/HeroMuhammad/Hero.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/HeroMuhammad/Weapon.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/HeroMuhammad/Armor.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/HeroMuhammad/Potion.inc.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
<?php
    // Crear un nuevo héroe
    $hero = new Hero("Muhammad", "Imperial", "Mago");

    // Crear armas
    $sword = new Weapon("Espada Larga", 15);
    $axe = new Weapon("Hacha de Batalla", 20);

    // Añadir armas al héroe
    $hero->weapons[] = $sword;
    $hero->weapons[] = $axe;

    // Crear armaduras
    $lightArmor = new Armor("Armadura Ligera", 15);
    $heavyArmor = new Armor("Armadura Pesada", 10);

    // Añadir armaduras al héroe
    $hero->armors[] = $lightArmor;
    $hero->armors[] = $heavyArmor;

    // Crear pociones
    $healingPotion1 = new Potion(20);
    $healingPotion2 = new Potion(30);

    // Añadir pociones al héroe
    $hero->potions[] = $healingPotion1;
    $hero->potions[] = $healingPotion2;

    echo '<p>';
    // Mostrar información del héroe
    echo $hero->__toString() . "<br>";

    // Realizar un ataque y mostrar el daño total
    $damage = $hero->attack();
    echo 'Daño total de ataque del Hero: ' . $damage . '<br>';

    // Calcular el daño recibido y mostrar la defensa
    $damageReceived = 25;
    $damageTaken = $hero->defense($damageReceived);
    echo 'Daño recibido por el Hero: ' . $damageReceived . ', Daño absorbido por el Hero: ' . $damageTaken . '<br>';

    echo 'Situacion del Hero <br>';
    echo $hero->__toString() . "<br>";

    // Usar la poción de mayor salud y mostrar la nueva salud
    $hero->usePotion();
    echo 'Salud después de usar la poción: ' . $hero->__get('health') . '<br>';

    // Mostrar información del héroe después de usar la poción
    echo $hero->__toString();
    echo '</p>';
?>    
</body>
</html>