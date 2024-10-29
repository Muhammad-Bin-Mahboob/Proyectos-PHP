<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Act => 5</title>
</head>
<body>
    <?php
    $numeros = [3, -7, 12, 5, -2, 8, 0, -15, 6, 9];
    foreach ($numeros as $numero) {
        echo $numero.'<br>';
    }
    echo '<br>';
    $orden = sort($numeros);
    foreach ($numeros as $numero) {
        echo $numero.'<br>';
    }
    ?>
</body>
</html>