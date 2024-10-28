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
    <?php
    echo '<table border="1">';
    echo '<tr>
               <td>Code</td><td>' . $_GET['code'] . '</td>
          </tr>';
    echo '<tr>
            <td>Name of Product</td><td>' . $_GET['name'] . '</td>
          </tr>';
    echo '<tr>
            <td>Price of Product</td><td>' . $_GET['price'] . '</td>
          </tr>';
    echo '<tr>
            <td>Description of Product</td><td>' . $_GET['description'] . '</td>
          </tr>';
    echo '<tr>
            <td>Manufacturer</td><td>' . $_GET['manufacturer'] . '</td>
          </tr>';
    echo '<tr>
            <td>Date of Acquisition</td><td>' . $_GET['acquisition_date'] . '</td>
          </tr>';
    echo '</table>';
    ?>
</body>
</html>


