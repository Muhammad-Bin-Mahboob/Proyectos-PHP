<?php
/**
 * Actividad para solicitud
 * 
 * @author Muhammad
 * @version 2.0
 */

$watermark = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].'/imagenes/marca.png');
$watermark = imagescale($watermark , 50);

imagealphablending($watermark, false);
imagesavealpha($watermark, true);

$watermarkWidth = imagesx($watermark);
$watermarkHeight = imagesy($watermark);

imagefilter($watermark, IMG_FILTER_COLORIZE, 0, 0, 0, 60);

$image = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].'/imagenes/candidatos/' . $_GET['img']);

$imageWidth = imagesx($image);
$imageHieght = imagesy($image);

imagecopy($image, $watermark, $watermarkWidth, 
$watermarkHeight, 0, 0, $imageWidth, $imageHieght);

header('content-type: image/png');

imagepng($image);

imagedestroy($image);
imagedestroy($watermark);