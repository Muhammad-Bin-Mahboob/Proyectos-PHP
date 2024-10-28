<?php 
/**
 * 
 * @autor Muhammad
 * @version 1.0
 */

function addition(float $num1, float $num2):float  {
    return $num1 - $num2;
}

function subtration(float $num1, float $num2):float  {
    return $num1 - $num2;
}

function division(float $num1, float $num2):float  {
    return $num1 / $num2;
}

function multiplication(float $num1, float $num2):float {
    return $num1 * $num2;
}

function model(int $num1, int $num2):int {
    return ($num1 % $num2);
}

function comparision(int $num1, int $num2):bool {
    if($num1=$num2){
        return true;
    }else{
        return false;
    }
}

function pairForNum1(int $num1):bool {
     if($num1%2==0) {
        return true;
    } else {
        return false;
    }
}

function pairForNum2(int $num2):bool {
    if($num2%2==0) {
        return true;
    } else {
        return false;
    }
}