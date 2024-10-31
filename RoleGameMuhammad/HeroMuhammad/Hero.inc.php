<?php
/**
 * @author Muhammad
 * @version 1.0
 */

class Hero {
    private $name;
    private $species;
    private $class;

    private $health;
    private $baseAttack;
    private $baseDefense;
    
    public $weapons = [];
    public $armors = [];
    public $potions = [];

    public function __construct(string $name, string $species, string $class, int $health = 50, int $baseAttack = 10, int $baseDefense = 10) {
        $this->name = $name;
        $this->__set('species', $species);
        $this->__set('class', $class);
        $this->health = $health;
        $this->baseAttack = $baseAttack;
        $this->baseDefense = $baseDefense;
    }

    public function __set($variable, $value) {
        switch ($variable) {
            case 'species':
                if ($this->checkSpecies($value)) {
                    $this->species = $value;
                } else {
                    $this->species = "Humano";
                }
                break;
            case 'class':
                if ($this->checkClass($value)) {
                    $this->class = $value;
                } else {
                    $this->class = "Ninguna";
                }                
                break;
            case 'weapons':
                if (count($this->weapons) < 2) {
                    $this->weapons[] = $value;
                } else {
                    echo "No puedes añadir más de 2 armas.<br>";
                }
                break;
            case 'armors':
                if (count($this->armors) < 1) {
                    $this->armors[] = $value;
                } else {
                    echo "No puedes añadir más de 1 armadura.<br>";
                }
                break;
            case 'potions':
                if (count($this->potions) < 3) {
                    $this->potions[] = $value;
                } else {
                    echo "No puedes añadir más de 3 pociones.<br>";
                }
                break;
            default:
                if (isset($this->$variable)) {
                    $this->$variable = $value;
                }
                break;
        }
    }    

    public function __get($variable) {
        if (isset($this->$variable)) {
            return $this->$variable;
        }
        return null;
    }

    public function __toString(): string {
        return 'Hero: ' . $this->name . 
        ', Species: ' . $this->species . 
        ', Class: ' . $this->class . 
        ', Health: ' . $this->health;
    }

    private function checkSpecies($species): bool {
        $validSpecies = [
            "Altmer", "Argoniano", "Bosmer", "Bretón", "Dunmer", 
            "Guardia rojo", "Imperial", "Khajiita", "Nórdico", "Orsimer"
        ];
        return in_array($species, $validSpecies);
    }

    private function checkClass($class): bool {
        $validClasses = [
            "Agente", "Arquero", "Asesino", "Bárbaro", "Brujo", 
            "Caballero", "Guerrero", "Ladrón", "Mago", "Monje"
        ];
        return in_array($class, $validClasses);
    }

    public function attack(): int {
        $totalAttack = $this->baseAttack;
        foreach ($this->weapons as $weapon) {
            $totalAttack += $weapon->attack;
        }
        return $totalAttack;
    }

    public function defense(int $damage): int {
        $baseDefense = $this->baseDefense;
    
        // Obtener la defensa de la armadura, si existe
        $armorDefense = 0;
        if (!empty($this->armors)) {
            foreach ($this->armors as $armor) {
                $armorDefense += $armor->defense; 
                // Sumar la defensa de todas las armaduras
            }
        }
        $totalDefense = $baseDefense + $armorDefense;
    
        // Calcula el daño final
        $damageTaken = $totalDefense - $damage;

        $this->health -= $damageTaken;
    
        if ($damageTaken <= 0) {
            return $result = 0;
        } else {
            return $result = $damageTaken;
        }
    }

    public function usePotion() {
        // Verificar si el héroe tiene pociones
        // en el caso que no los hay
        // devuelve nada
        if (empty($this->potions)) {
            return; 
        }
    
        $maxHealthPotion = null; 
        // Variable para almacenar la poción de mayor salud
    
        // Recorrer todas las pociones
        for ($i = 0; $i < count($this->potions); $i++) {
            $potion = $this->potions[$i]; 
    
            // en el caso de que no hemos asignado una poción 
            // o si la poción actual [i] tiene mas salud
            if ($maxHealthPotion === null || $potion->health > $maxHealthPotion->health) {
                // Actualizamos la poción de mayor salud
                $maxHealthPotion = $potion; 
            }
        }
    
        // Sumar la salud de la poción de mayor salud al héroe
        $this->health += $maxHealthPotion->health;
    
        $newPotions = []; 
        // Esta lista contendrá las pociones restantes
    
        // Recorrer nuevamente todas las pociones para conservar las que no se usaron
        for ($i = 0; $i < count($this->potions); $i++) {
            $potion = $this->potions[$i]; 
            // Comparar cada poción con la poción de mayor salud
            if ($potion !== $maxHealthPotion) {
                // Si la poción no es la que acabamos de usar, agregarla a la nueva lista
                $newPotions[] = $potion; 
            }
        }
    
        // Actualizar la lista de pociones del héroe
        $this->potions = $newPotions; 
    }
}
