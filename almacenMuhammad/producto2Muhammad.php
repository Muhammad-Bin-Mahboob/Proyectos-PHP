<?php
/**
 * Actividad para introducir datos en el almacén
 * 
 * @author Muhammad
 * @version 1.0
 */

if(!empty($_POST)){
    foreach($_POST as $key => $value){
        $_POST[$key] = trim($value);
        if(empty($_POST[$key])){
            $errors[$key]= $key.' no puede estrar vacío.';//error: un message diciendo que campo tiene error. 
        }
    }
    print_r($errors);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Form for Products</h1>
    <form action="#" method="post">
        <label for="code">Code of Product:</label>
        <input id="code" name="code" value="<?=(isset($_POST['code'])) ? $_POST['code'] : '' ?>">
        <!-- (isset($_POST['code'])) ? $_POST['code'] : '' 
                puedo hacer el value asi o asi
                    $_POST['user'] ?? '' -->
        
        <label for="name">Name of Product:</label>
        <input id="name" name="name" value="<?=(isset($_POST['name'])) ? $_POST['name'] : '' ?>">
        
        <label for="price">Price of Product:</label>
        <input id="price" name="price" value="<?=(isset($_POST['price'])) ? $_POST['price'] : '' ?>">
        
        <label for="description">Description of Product:</label>
        <textarea id="description" name="description" value="<?=(isset($_POST['description'])) ? $_POST['description'] : '' ?>"></textarea>
        
        <label for="manufacturer">Manufacturer of Product:</label>
        <input id="manufacturer" name="manufacturer" value="<?=(isset($_POST['manufacturer'])) ? $_POST['manufacturer'] : '' ?>">
        
        <label for="acquisition_date">Date of Acquisition:</label>
        <input id="acquisition_date" name="acquisition_date" value="<?=(isset($_POST['acquisition_date'])) ? $_POST['acquisition_date'] : '' ?>">

        <input type="submit" value="Enviar">
    </form>
</body>
</html>