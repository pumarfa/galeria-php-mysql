<?php // Panel

include "../config.php";
include "../lib.php";

$fkgaleria = $_POST['idgaleria'];
$cantidad = $_POST['cantidad'];
$allowed = array('bmp','gif', 'png', 'jpg');

// Para cada imagen seleccionada
foreach( $_POST['nombre'] as $indice=>$nombre){
    $filename = strtolower( $_FILES['archivo']['name'][$indice] );
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    // Verificar si el formato está soportado
    if ( in_array($ext, $allowed) ) {
      // Preparar variables de entorno para procesar la imagen
        $original = $_FILES['archivo']['tmp_name'][$indice];
        $nombre_file = md5(mktime(). $_FILES['archivo']['name'][$indice]).'.'.$ext;
        $destino = "../fotos/$nombre_file";
        $miniatura = "../images/$nombre_file";

        // Subir el ARCHIVO
        if (move_uploaded_file( $original, $destino )){
          //Si se subió con éxito, continuo...
          $descripcion = $_POST['descripcion'][$indice];
          $estado = $_POST['estado'][$indice];
          $posicion = $cantidad + $indice;
          // Consulta para cargar la base de datos
          $consulta =<<<SQL
              INSERT INTO
                  fotos
              SET
                  NOMBRE='$nombre',
                  DESCRIPCION='$descripcion',
                  ARCHIVO='$nombre_file',
                  POSICION='$posicion',
                  ESTADO='$estado',
                  FECHA_ALTA = NOW(),
                  FKGALERIA='$fkgaleria'
          SQL;
          // Guardar el registro en la DB
          mysqli_query($cnx, $consulta);
          $idimage = mysqli_insert_id($cnx);
          // Llamar a la función de palagras
          if ( !wordstag ($cnx, $idimage, $descripcion ) ){
            echo "Error";
            exit();
          }
          // Crear u guardar las miniaturas
          if (true !== ($pic_error = @image_resize($destino, $miniatura, 231,231, 1))) {
            echo $pic_error;
            unlink($pic_name);
          }

        }else {
            echo "ERROR: No se pudo guardar el archivo.<br>";
      }
    } else {
      echo "ERROR: El formato de archivo no es aceptado, extensión:".$ext." <br>";
    }
}

header("Location: fotos_galeria.php?id=$fkgaleria");
?>
