<?php
/**
 * @author Muhammad
 * @version 1.0
 */

class Weapon {
    private $name;
    public $attack;

    public function __construct(string $name, int $attack) {
        $this->name = $name;
        $this->attack = $attack;
    }

    public function __get($property) {
        return $this->$property;
    }

    public function __set($property, $value) {
        $this->$property = $value;
    }

    public function toString(): string {
        return 'Arma: ' . $this->name . ', Ataque: ' . $this->attack;
    }
}
