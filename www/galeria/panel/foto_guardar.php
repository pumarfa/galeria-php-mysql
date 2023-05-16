<?php // Panel

include "../config.php";
include "../lib.php";

$idfoto = $_POST['idfoto'];
$idgaleria = $_POST['idgaleria'];
$estado = $_POST['estado'];
$filename = $_POST['archivo'];
$descripcion = $_POST['descripcion'];

// Borrar el analisis de palabras de la foto para generar el nuevo.
$fotospalabras =<<<SQL
DELETE FROM `fotospalabras` WHERE `FKFOTO`='$idfoto'
SQL;
mysqli_query($cnx, $fotospalabras);

if ( $estado == '2'){
  // Borrar la foto y todos sus datos de la DB
    $consulta =<<<SQL
    DELETE FROM `fotos` WHERE IDFOTO='$idfoto' LIMIT 1
    SQL;

    if ( file_exists('../fotos/'.$filename ) ) {
      unlink ('../fotos/'.$filename);
    }
    if ( file_exists('../images/'.$filename) ) {
      unlink ('../images/'.$filename);
    }

} else {
  // Actualizar la descripcion de la foto
    $consulta =<<<SQL
    UPDATE fotos SET DESCRIPCION='$descripcion', ESTADO = '$estado' WHERE IDFOTO='$idfoto' LIMIT 1
    SQL;
    // Llamar a la función de palabras para procesar la descripcion
    if ( !wordstag ($cnx, $idimage, $descripcion ) ){
       echo "Error";
       exit();
    }
}   

mysqli_query($cnx, $consulta);


header("Location: fotos_galeria.php?id=$idgaleria#one");
?>
