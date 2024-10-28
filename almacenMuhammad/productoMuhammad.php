<?php
/**
 * Actividad para introducir datos en el almacén
 * 
 * @author Muhammad
 * @version 1.0
 */
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
    <form action="processMuhammad.php" method="GET">
        <label for="code">Code of Product:</label>
        <input id="code" name="code">
        
        <label for="name">Name of Product:</label>
        <input id="name" name="name">
        
        <label for="price">Price of Product:</label>
        <input id="price" name="price">
        
        <label for="description">Description of Product:</label>
        <textarea id="description" name="description"></textarea>
        
        <label for="manufacturer">Manufacturer of Product:</label>
        <input id="manufacturer" name="manufacturer">
        
        <label for="acquisition_date">Date of Acquisition:</label>
        <input id="acquisition_date" name="acquisition_date">

        <input type="submit" value="Enviar">
    </form>
</body>
</html>