<?php
/**
 * Actividad para comprobar los datos
 * 
 * @autor Muhammad
 * @versión 2.0
 */

$errors = [];

if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = trim($value);
        // Verificar si el campo está vacío
        if (empty($_POST[$key])) {
            $errors[$key] = $key . ' no puede estar vacío.';
        } else {
            // Validar cada campo por separado
            switch ($key) {
                case 'code':
                    if (!preg_match('/^[A-Za-z]-\d{5}$/', $_POST[$key])) {
                        $errors['code'] = 'Código debe ser una letra seguida de un guion y 5 dígitos.';
                    }
                    break;
 
                case 'name':
                    if (!preg_match('/^[A-Za-z]{3,20}$/', $_POST[$key])) {
                        $errors['name'] = 'Nombre debe contener solo letras y tener entre 3 y 20 caracteres.';
                    }
                    break;
 
                case 'price':
                    if (!preg_match('/^\d+(\.\d+)$/', $_POST[$key])) {
                        $errors['price'] = 'Precio debe ser un número decimal válido.';
                    }
                    break;
 
                case 'description':
                    if (!preg_match('/^[A-Za-z0-9\s]{50,}$/', $_POST[$key])) {
                        $errors['description'] = 'Descripción debe ser alfanumérica y tener al menos 50 caracteres.';
                    }
                    break;
 
                case 'manufacturer':
                    if (!preg_match('/^[a-zA-Z0-9]{10,20}$/', $_POST[$key])) {
                        $errors['manufacturer'] = 'Fabricante debe ser alfanumérico y tener entre 10 y 20 caracteres.';
                    }
                    break;
 
                case 'acquisition_date':
                    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST[$key])) {
                        $errors['acquisition_date'] = 'Fecha de adquisición debe tener el formato YYYY-MM-DD.';
                    }
                    break;
            }
        }
    }
    // Imprimir los errores si los hay
    print_r($errors);
 }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inicial-scale=1.0">
    <title>Formulario de Productos</title>
</head>
<body>
    <?php 
    if (empty($errors) && !empty($_POST)){ 
    ?>
        <h1>Producto almacenado correctamente</h1>
        <a href="productMuhammad.php">Ir a la página del producto</a>
    <?php
    }else { 
    ?>
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
    <?php
    }
    ?>
</body>
</html>