<?php // Panel

include "../config.php";

$idgaleria = $_POST['idgaleria'];
$posicion = 0;
foreach( $_POST['posicion'] as $numero=>$idfoto ){
  $estado = $_POST['estado'][$numero];
  $filename = $_POST['archivo'][$numero];
  if ( $estado == '2'){
    $consulta =<<<SQL
    DELETE FROM `fotos` WHERE IDFOTO='$idfoto' LIMIT 1
    SQL;

    if ( file_exists('../fotos/'.$filename ) ) {
      unlink ('../fotos/'.$filename);
    }
    if ( file_exists('../images/'.$filename) ) {
      unlink ('../images/'.$filename);
    }

    $fotospalabras =<<<SQL
    DELETE FROM `fotospalabras` WHERE `FKFOTO`='$idfoto'
    SQL;
    mysqli_query($cnx, $fotospalabras);
  } else {
    $consulta =<<<SQL
    UPDATE fotos SET POSICION='$posicion', ESTADO = '$estado' WHERE IDFOTO='$idfoto' LIMIT 1
    SQL;
    $posicion++;
  }
  mysqli_query($cnx, $consulta);

}

header("Location: fotos_galeria.php?id=$idgaleria");
?>
