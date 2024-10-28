<?php
/**
 * Actividad para solicitud
 * 
 * @author Muhammad
 * @version 2.0
 */

$errors = [];

if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = trim($value);
        // Verificar si el campo está vacío
        if (empty($_POST[$key])) {
            if ($key !== 'surname2') {
                $errors[$key] = $key . ' no puede estar vacío.';
            }
        } else {
            // Validar cada campo por separado
            switch ($key) {
                case 'usuario':
                    if (!preg_match('/^[a-zA-Z0-9]{3,20}$/', $_POST[$key])) {
                        $errors['usuario'] = 'Usuario debe contener solo letras y tener entre 3 y 20 caracteres.';
                    }
                    break;
            
                case 'name':
                    if (!preg_match('/^[a-zA-Z\s]+$/', $_POST[$key])) {
                        $errors['name'] = 'Nombre debe contener solo letras y puede contener espacios.';
                    }
                    break;
            
                case 'surname2':
                    if (!preg_match('/^[a-zA-Z\s]+$/', $_POST[$key])) {
                        $errors['surname2'] = 'El primer apellido debe contener solo letras y puede contener espacios.';
                    }
                    break;

                case 'surname2':
                    if (!preg_match('/^[a-zA-Z\s]+$/', $_POST[$key])) {
                        $errors['surname2'] = 'El segundo apellido debe contener solo letras y puede contener espacios.';
                    }
                    break;
            
                case 'DNI':
                    if (!preg_match('/^\d{8}[a-zA-Z]$/', $_POST[$key])) {
                        $errors['DNI'] = 'DNI debe ser un número de 8 dígitos seguido de una letra.';
                    }
                    break;
            
                case 'direction':
                    if (!preg_match('/^[a-zA-Z0-9\s.,#-]+$/', $_POST[$key])) {
                        $errors['direction'] = 'Dirección puede ser alfanumérica y tener entre 10 y 50 caracteres. Ej: Calle Jose Maria 2';
                    }
                    break;
            
                case 'email':
                    if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $_POST[$key])) {
                        $errors['email'] = 'El correo electrónico debe contener una parte alfanumérica seguida de un símbolo @, luego otra parte alfanumérica, seguida de un punto (.) y finalmente un dominio de nivel superior que contenga al menos 2 letras. Ej: muhmah@gmail.es';
                    }
                    break;
            
                case 'phone':
                    if (!preg_match('/^\d{9}$/', $_POST[$key])) {
                        $errors['phone'] = 'Número de teléfono debe tener entre 9 dígitos.';
                    }
                    break;
            
                case 'birthday':
                    if (!preg_match('/^([0-2][0-9]|3[01])-(0[1-9]|1[0-2])-(\d{4})$/', $_POST[$key])) {
                        $errors['birthday'] = 'Fecha de nacimiento debe tener el formato DD-MM-YYYY. Mes(01-12) y Dias(01-31).';
                    }
                    break;
            }
        }
    }
}

if (!empty($_POST)) {
    // Comprobar errores de archivo
    if ($_FILES['curriculum']['error'] != UPLOAD_ERR_OK) {
        switch ($_FILES['curriculum']['error']) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE: $errors['curriculum'] = 'El pdf es demasiado grande.';
            break;
            case UPLOAD_ERR_PARTIAL: $errors['curriculum'] = 'El pdf no se ha podido subir entero.';
            break;
            case UPLOAD_ERR_NO_FILE: $errors['curriculum'] = 'No se ha podido subir el pdf.';
            break;
            default: $errors['curriculum'] = 'Error para el pdf.';   
        }
    }

    if ($_FILES['foto']['error'] != UPLOAD_ERR_OK) {
        //echo 'Error: ';
        switch ($_FILES['foto']['error']) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE: $errors['foto'] = 'La foto es demasiado grande.';
            break;
            case UPLOAD_ERR_PARTIAL: $errors['foto'] = 'La foto no se ha podido subir entera.';
            break;
            case UPLOAD_ERR_NO_FILE: $errors['foto'] = 'No se ha podido subir la foto.';
            break;
            default: $errors['foto'] = 'Error para la foto.';
        }
    }

    if (empty($errors)) {
        // Validar Curriculum
        if ($_FILES['curriculum']['error'] == UPLOAD_ERR_OK) {
            $curriculumTmpPath = $_FILES['curriculum']['tmp_name'];
            $curriculumType = $_FILES['curriculum']['type'];

            // Verificar tipo de archivo
            if ($curriculumType !== 'application/pdf') {
                $errors['curriculum'] = 'El currículum debe ser un archivo PDF.';
            } else {
                // Guardar el curriculum
                $curriculumFilename = $_POST['DNI'].'-'.$_POST['name'].'-'.$_POST['surname1'].'.pdf';
                // 12345678p-jam-sanchez.png
                $curriculumDestination = $_SERVER['DOCUMENT_ROOT'].'/cvs/' . $curriculumFilename; // Guardar en la carpeta cvs
                 // $ruta = 
                 // 'C:\laragon\www\ofertaTrabajoMuhammad
                 // \cvs\
                 // 12345678p-jam-sanchez.png';
                if (!move_uploaded_file($curriculumTmpPath, $curriculumDestination)) {
                    $errors['curriculum'] = 'Error al guardar el currículum.';
                }
            }
        } else {
            $errors['curriculum'] = 'Error al subir el currículum.';
        }
        // Validar Foto
        if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $fotoTmpPath = $_FILES['foto']['tmp_name'];
            $fotoType = $_FILES['foto']['type'];

            // Verificar tipo de archivo
            if ($fotoType !== 'image/png') {
                $errors['foto'] = 'La foto debe ser una imagen PNG.';
            } else {
                // Guardar la foto
                $fotoFilename = $_POST['DNI'] . '.png';
                $fotoDestination = $_SERVER['DOCUMENT_ROOT'].'/imagenes/candidatos/' . $fotoFilename; 
                // $ruta = 'C:\laragon\www\ofertaTrabajoMuhammad\imagenes\candidatos\12345678p.png';
                
                // Guardar en la carpeta candidates
                if (!move_uploaded_file($fotoTmpPath, $fotoDestination)) {
                    $errors['foto'] = 'Error al guardar la foto.';
                }
            }
        } else {
            $errors['foto'] = 'Error al subir la foto.';
        }

        if(empty($errors)){

            $oldFoto = $_SERVER['DOCUMENT_ROOT'].'/imagenes/candidatos/' . $_POST['DNI'] . '.png';

            $originalImage = imagecreatefrompng($oldFoto);
            
            $newWidth = intval(imagesx($originalImage)/2);
            $newHeight = intval(imagesy($originalImage)/2);
            
            $newImage = imagecreatetruecolor($newWidth, $newHeight);

            imagecopyresized($newImage, $originalImage, 
            0, 0, 0, 0, $newWidth, $newHeight, imagesx($originalImage)
            ,imagesy($originalImage));

            $newfotoDestination = $_SERVER['DOCUMENT_ROOT'] . '/imagenes/candidatos/' . $_POST['DNI'] . '-thumbnail.png';
            imagepng($newImage, $newfotoDestination);
        }
    }
    print_r($errors);

    // Si no hay errores, proceder a guardar los archivos
    if (empty($errors)) {
        echo '<h1>Se ha registrado correctamente la solicitud.</h1>';
        echo '<a href="index.php">Ir a index.</a>';
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inicial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles\styles.css">
    <title>Formulario</title>
</head>
<body>
    <?php 
    if (empty($errors) && !empty($_POST)){ 
    ?>
        <h1>Se ha registrado correctamente la solicitud.</h1>
        <a href="index.php">Ir a</a>
    <?php
    }else { 
    ?>
    <h1 class="color">Form for Products</h1>
    <form action="#" method="post"  enctype="multipart/form-data">
        <label for="usuario">Usuario:</label>
        <input id="usuario" name="usuario" value="<?=(isset($_POST['usuario'])) ? $_POST['usuario'] : '' ?>"><br>
        
        <label for="name">Name:</label>
        <input id="name" name="name" value="<?=(isset($_POST['name'])) ? $_POST['name'] : '' ?>"><br>
        
        <label for="surname1">First Surname:</label>
        <input id="surname1" name="surname1" value="<?=(isset($_POST['surname1'])) ? $_POST['surname1'] : '' ?>"><br>

        <label for="surname2">Second Surname:</label>
        <input id="surname2" name="surname2" value="<?=(isset($_POST['surname2'])) ? $_POST['surname2'] : '' ?>"><br>
        
        <label for="DNI">DNI:</label>
        <input id="DNI" name="DNI" value="<?=(isset($_POST['DNI'])) ? $_POST['DNI'] : '' ?>"><br>
        
        <label for="direction">Direction:</label>
        <input id="direction" name="direction" value="<?=(isset($_POST['direction'])) ? $_POST['direction'] : '' ?>"><br>
        
        <label for="email">E-mail:</label>
        <input id="email" name="email" value="<?=(isset($_POST['email'])) ? $_POST['email'] : '' ?>"><br>

        <label for="phone">Telephone:</label>
        <input id="phone" name="phone" value="<?=(isset($_POST['phone'])) ? $_POST['phone'] : '' ?>"><br>

        <label for="birthday">Date of Birth:</label>
        <input id="birthday" name="birthday" value="<?=(isset($_POST['birthday'])) ? $_POST['birthday'] : '' ?>"><br>

        <label for="curriculum">Curriculum:</label>
        <input type="file" id="curriculum" name="curriculum"><br>

        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto"><br>

        <input type="submit" value="Enviar">
    </form>
    <?php
    }
    ?>
    <br>
    <a href="candidatos.php">Watermark.</a>
<footer>
    <div>
        <h2 class="color">Muhammad Bin Mahboob</h2>
        <img src="imagenes\fotoDeCarnet.jpg" alt="Yo" class="foto">
    </div>
</footer>
</body>
</html>