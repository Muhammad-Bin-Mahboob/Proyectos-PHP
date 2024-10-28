<?php
/**
 * Actividad para Login
 * 
 * @author Muhammad
 * @version 2.0
 */

class User {
    private string $username;
    private string $password;
    private string $mail;
    private bool $logged = false;

    public function __construct(string $username, string $password, string $email) {
        $this->username = $username;
        $this->password = $password;
        $this->mail = $email;
    }

    public function __set($variable, $value) {
        if (isset($this, $variable) && $variable !== 'logged') {
            $this->$variable = $value;
        }
    }

    public function __get($variable) {
        if (isset($this, $variable)) {
            return $this->$variable;
        } else {
            return null;
        }
        
    }

    public function login(string $pass): bool {
        // si el usuario ya estaba loggeado o password es 
        // incorecto develvo false
        if ($this->logged || $pass !== $this->password) {
            return false;
        }
        // si el usuario no estaba loggeado cambio
        // logged a true y develvo true
        $this->logged = true;
        return true;
    }    
    
    public function logout() {
        // si el usuario es loggeado cambio
        // logged a false y devuelvo true
        if ($this->logged) {
            $this->logged = false;
            return true;
        }
        // sino Retorna false, indicando que 
        // no se realizó ninguna acción porque el usuario
        // ya estaba false.
        return false;
    }

    public function __toString(): string {
        return "User: $this->username, Email: $this->mail";
    }
}
