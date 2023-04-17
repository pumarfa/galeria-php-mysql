<?php // Panel

if ( isset($_GET['id'])){
  include "../config.php";

  $id = $_GET['id'];
  // Primero verificar que no tenga fotos la galerias
  $consulta =<<<SQL
  SELECT
    COUNT(*) as `count`
  FROM
    `fotos`
  WHERE
    `ESTADO` = 1 AND `FKGALERIA` = '$id'
  SQL;

  $filas = mysqli_query($cnx, $consulta);
  $fotos = mysqli_fetch_assoc($filas);
  if(  $fotos['count'] == 0 ){
    // La galeria está vacía.
    $consulta =<<<SQL
    DELETE FROM galerias
    WHERE IDGALERIA='$id'
    LIMIT 1
    SQL;

    mysqli_query($cnx, $consulta);
    $mesage = "La Galeria $id se borró";
  } else {
    $mesage = "La Galeria contiene imágenes. Debe eliminarlas primero";
  }
}
header("Location: index.php?mesage=".$mesage."#one");

?>
