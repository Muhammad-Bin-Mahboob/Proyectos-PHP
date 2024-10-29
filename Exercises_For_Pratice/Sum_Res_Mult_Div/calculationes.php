<?php 
/**
 * 
 * @author Muhammad
 * @version 1.0
 */

function addition(float $num1, float $num2):float  {
    $result = $num1 + $num2;
    return $result;
}

print_r(addition(5.2,5.2));

function subtration(float $num1, float $num2):float  {
    $result = $num1 - $num2;
    return $result;
}

function division(float $num1, float $num2):float  {
    $result = $num1 / $num2;
    return $result;
}

function multiplication(float $num1, float $num2):float {
    $result = $num1 * $num2;
    return $result;
}

function model(int $num1, int $num2) {
    $result = ($num1 % $num2);
    return $result;
}

function comparision(int $num1, int $num2):bool {
    if($num1=$num2){
        return true;
    }else{
        return false;
    }
}

function pair(int $num1, int $num2):bool {
     if($num1%2==0) {
        return true;
    } elseif ($num2%2==0) {
        return false;
    }
}