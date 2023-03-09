<?php
/**
* Función para redimensionar imágenes y guardarlas
* Parametros
* $src: Objeto de imágen original
* $dst: Path y nombre de archivo a guardarlas
* $width: Ancho de la imagen resultado
* $height: Altura de la imagen resultado
* $crop: Especifica a la función si escala o recorta la imágenes
*/
function image_resize($src, $dst, $width, $height, $crop=0){

  if(!list($w, $h) = getimagesize($src)) return "Unsupported picture type!";

  $type = strtolower(substr(strrchr($src,"."),1));
  if($type == 'jpeg') $type = 'jpg';
  switch($type){
    case 'bmp': $img = imagecreatefromwbmp($src); break;
    case 'gif': $img = imagecreatefromgif($src); break;
    case 'jpg': $img = imagecreatefromjpeg($src); break;
    case 'png': $img = imagecreatefrompng($src); break;
    default : return "Unsupported picture type!:";
  }

  // resize
  if($crop){
    if($w < $width or $h < $height) return "Picture is too small!";
    $ratio = max($width/$w, $height/$h);
    $h = $height / $ratio;
    $x = ($w - $width / $ratio) / 2;
    $w = $width / $ratio;
  }
  else{
    if($w < $width and $h < $height) return "Picture is too small!";
    $ratio = min($width/$w, $height/$h);
    $width = $w * $ratio;
    $height = $h * $ratio;
    $x = 0;
  }

  $new = imagecreatetruecolor($width, $height);

  // preserve transparency
  if($type == "gif" or $type == "png"){
    imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
    imagealphablending($new, false);
    imagesavealpha($new, true);
  }

  imagecopyresampled($new, $img, 0, 0, $x, 0, $width, $height, $w, $h);

  switch($type){
    case 'bmp': imagewbmp($new, $dst); break;
    case 'gif': imagegif($new, $dst); break;
    case 'jpg': imagejpeg($new, $dst); break;
    case 'png': imagepng($new, $dst); break;
  }
  return true;
}

/**
* Función que relaciona las palabras claves de la descripciónde con la imagen cargada
* Parametros:
* $cnx: Conexión a base de datos.
* $idfoto : El IDFOTO cargada en la base de datos
* $descripción: String con la descripcion de la foto.
*/
function wordstag ($cnx, $idfoto, $descripcion ){

$msg = true;
$palabras_especiales = array('fce', 'fceqyn', 'fhycs', 'fcf', 'ee', 'fi', 'fio', 'fayd','fa','facfor');

  // Procesar y optener las palabras del string de entrada DESCRIPCION
  $descripcion = strtolower($descripcion);
  $palabras  = str_word_count($descripcion, 1);
  foreach ($palabras as $palabra => $value) {
    if( strlen($value) >= '4' || in_array($value, $palabras_especiales) ){
      // Optener palabras de la base de datos
      $consulta = "SELECT IDPALABRA, DESCRIPCION, NUMERO FROM palabras WHERE DESCRIPCION = '$value' LIMIT 1";

      $resultado = mysqli_query($cnx, $consulta);
      if ( $words = mysqli_fetch_assoc($resultado) ){
        $idword = $words['IDPALABRA'];
        $updateword = "UPDATE `palabras` SET `NUMERO`= `NUMERO`+1 WHERE `DESCRIPCION`= '$value' LIMIT 1";
        mysqli_query($cnx, $updateword);
      } else {
        $insertword ="INSERT INTO `palabras`( `DESCRIPCION`, `NUMERO`) VALUES ('$value', '0')";
        $resultinsertword = mysqli_query($cnx, $insertword);
        $idword = mysqli_insert_id($cnx);
      }

      $consulta = "INSERT INTO `fotospalabras`(`FKFOTO`, `FKPALABRA`) VALUES ('$idfoto','$idword' )";
      $resultado = mysqli_query($cnx, $consulta);
    }
  }
  return $msg;
  //echo "<hr>";
  //exit();
  //echo "<hr>";
  //print("<pre>".print_r($palabras,true)."</pre>");
}
?>
