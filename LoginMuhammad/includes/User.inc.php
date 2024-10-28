<?php
/**
 * Actividad para Login
 * 
 * @author Muhammad
 * @version 2.0
 */

class User{
    private string $username;
    private string $password;
    private string $mail;
    private bool $logged = false;

    public function __construct(string $username, string $password, string $email) {
        $this->username = $username;
        $this->password = $password;
        $this->mail = $email;
    }

    public function __set($variable, $value){
        if(isset($this->$variable)){
            if($variable !== 'logged'){
                $this->$variable = $value;
            }
        }
    }

    public function __get($variable){
        if(isset($this->$variable)){
            return $this->$variable;
        }
    }

    
    public function login($pass) {
        if ($this->logged == true) {
            return false;
        }

        if ($this->logged == false) {
            if ($pass == $this->password) {
                $this->logged = true;
                return true;
            }
        }
    }
    
    public function logout() {
        if ($this->logged = true) {
            $this->logged = false;
            return true;
        }
        return false;
    }

    public function __toString(){
        return "User: $this->username, Email: $this->mail";
    }
}