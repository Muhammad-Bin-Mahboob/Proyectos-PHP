<?php
/**
 * @author Muhammad
 * @version 1.0
 */

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
// Crear instancia de Hero
$hero = new Hero("Muhammad", "Nórdico", "Guerrero");

// Mostrar información inicial del héroe
echo $hero . "<br>";

echo "<br>";

// Añadir armas
$weapon1 = new Weapon("Espada larga", 15);
$weapon2 = new Weapon("Daga", 5);
$weapon3 = new Weapon("Arco", 7);

$hero->__set('weapons', $weapon1);
echo $weapon1->toString() . "<br>";

$hero->__set('weapons', $weapon2);
echo $weapon2->toString() . "<br>";

// Intentar añadir una tercera arma y ver el mensaje de error
$hero->__set('weapons', $weapon3);

echo "<br>";

// Añadir armadura
$armor = new Armor("Cota de malla", 20);
$hero->__set('armors', $armor);
echo $armor->toString() . "<br>";

// Intentar añadir una segunda armadura y ver el mensaje de error
$secondArmor = new Armor("Escudo", 10);
$hero->__set('armors', $secondArmor);

echo "<br>";

// Añadir pociones
$potion1 = new Potion(20);
$potion2 = new Potion(5);
$potion3 = new Potion(10);
$potion4 = new Potion(30);

$hero->__set('potions', $potion1);
echo $potion1->toString() . "<br>";

$hero->__set('potions', $potion2);
echo $potion2->toString() . "<br>";

$hero->__set('potions', $potion3);
echo $potion3->toString() . "<br>";

// Intentar añadir una cuarta poción y ver el mensaje de error
$hero->__set('potions', $potion4);

echo "<br>";

// Probar el método de ataque y defensa
echo "Ataque total del héroe: " . $hero->attack() . "<br>";

echo "<br>";

$damagehecho=25;
$damageTaken = $hero->defense($damagehecho);
echo "Daño echo al héroe: " . $damagehecho . "<br>";
echo "Daño recibido por el héroe después de la defensa: " . $damageTaken . "<br>";

// Usar una poción y mostrar la salud del héroe
$hero->usePotion();
echo "Salud del héroe después de usar poción: " . $hero->__get('health') . "<br>";

echo "<br>";

// Mostrar información final del héroe
echo $hero . "<br>";


echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";



// Crear instancia de Hero2
$hero2 = new Hero("Alex", "Profesor", "2Daw");

// Mostrar información inicial del héroe
echo $hero2 . "<br>";

echo "<br>";

// Añadir armas
$weapon1 = new Weapon("Espada larga", 15);
$weapon2 = new Weapon("Daga", 5);
$weapon3 = new Weapon("Arco", 7);

$hero2->__set('weapons', $weapon1);
echo $weapon1->toString() . "<br>";

$hero2->__set('weapons', $weapon2);
echo $weapon2->toString() . "<br>";

// Intentar añadir una tercera arma y ver el mensaje de error
$hero2->__set('weapons', $weapon3);

echo "<br>";

// Añadir armadura
$armor = new Armor("Cota de malla", 20);
$hero2->__set('armors', $armor);
echo $armor->toString() . "<br>";

// Intentar añadir una segunda armadura y ver el mensaje de error
$secondArmor = new Armor("Escudo", 10);
$hero2->__set('armors', $secondArmor);

echo "<br>";

// Añadir pociones
$potion1 = new Potion(20);
$potion2 = new Potion(5);
$potion3 = new Potion(10);
$potion4 = new Potion(30);

$hero2->__set('potions', $potion1);
echo $potion1->toString() . "<br>";

$hero2->__set('potions', $potion2);
echo $potion2->toString() . "<br>";

$hero2->__set('potions', $potion3);
echo $potion3->toString() . "<br>";

// Intentar añadir una cuarta poción y ver el mensaje de error
$hero2->__set('potions', $potion4);

echo "<br>";

// Probar el método de ataque y defensa
echo "Ataque total del héroe: " . $hero2->attack() . "<br>";

echo "<br>";

$damagehecho=25;
$damageTaken = $hero2->defense($damagehecho);
echo "Daño echo al héroe: " . $damagehecho . "<br>";
echo "Daño recibido por el héroe después de la defensa: " . $damageTaken . "<br>";

// Usar una poción y mostrar la salud del héroe
$hero2->usePotion();
echo "Salud del héroe después de usar poción: " . $hero2->__get('health') . "<br>";

echo "<br>";

// Mostrar información final del héroe
echo $hero2 . "<br>";
?>    
</body>
</html>