<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Recursivo</title>
</head>
<body>
    <h1>Registrate</h1>
    <?php
    header('Location: /index.php');
    exit;
    if(!empty($_POST)){
        //print_r($_POST);
        foreach($_POST as $key => $value){
            $_POST[$key] = trim($value);
            //coge el user que esta en $_POST y 
            //quita espacio de su value.
        }
    }
    ?>
    <form action="#" method="POST">
        Usuario <input type="text" name="user" value="<?=(isset($_POST['user'])) ? $_POST['user'] : '' ?>"></input><br>
        E-Mail <input type="text" name="email" value="<?=(isset($_POST['email'])) ? $_POST['email'] : '' ?>"></input><br>
        <input type="submit" value="Registrarse"></input><br>
    </form>
</body>
</html>