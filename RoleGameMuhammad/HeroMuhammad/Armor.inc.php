<?php
/**
 * @author Muhammad
 * @version 1.0
 */

class Armor {
    private $name;
    public $defense;

    public function __construct(string $name, int $defense) {
        $this->name = $name;
        $this->defense = $defense;
    }

    public function __get($property) {
        return $this->$property;
    }

    public function __set($property, $value) {
        $this->$property = $value;
    }

    public function toString(): string {
        return 'Armadura: ' . $this->name . ', Defensa: ' . $this->defense;
    }
}



