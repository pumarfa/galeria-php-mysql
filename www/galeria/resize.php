<?php
// The file
include "lib.php";
// Set a maximum height and width
$width = 231;
$height = 231;
$path = "fotos";

$dir = opendir($path);
// Leo todos los ficheros de la carpeta
while ($elemento = readdir($dir)){
    // Tratamos los elementos . y .. que tienen todas las carpetas
    if( $elemento != "." && $elemento != ".."){
        // Si es una carpeta
        if( is_dir($path.$elemento) ){
            // Muestro la carpeta
            echo "<p><strong>CARPETA: ". $elemento ."</strong></p>";
        // Si es un fichero
        } else {
            // Muestro el fichero
            echo "<img src='fotos/$elemento'> <br>";
            $origen = "./fotos/".$elemento;
            $miniatura = "./images/".$elemento;
            if (true !== ($pic_error = @image_resize($origen, $miniatura, 231,231, 1))) {
              echo $pic_error;
              unlink($pic_name);
            }
            echo "<hr>";
            echo "<img src='images/$elemento'> <br>";
            echo "<hr>";
        }
    }
}
?>
