<?php
/**
 * @author Muhammad
 * @version 1.0
 */

class Potion {
    public $health;

    public function __construct(int $health) {
        $this->health = $health;
    }

    public function __get($property) {
        return $this->$property;
    }

    public function __set($property, $value) {
        $this->$property = $value;
    }

    public function toString() {
        return 'Salud: ' . $this->health;
    }
}



