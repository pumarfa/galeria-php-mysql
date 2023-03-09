<?php

include "config.php";
include "lib.php";

$idfoto = '6';
$descripcion = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed consectetur Palabra faucibus libero eget bibendum. Cras ut odio sit amet nisl vulputate condimentum. Etiam sed neque accumsan, varius felis eu, dictum velit. Proin iaculis egestas bibendum. Nulla facilisi. Cras mattis nulla justo, sed molestie velit viverra nec. Nam dapibus nibh et laoreet pharetra. Vestibulum quis luctus lacus. Nulla facilisi. Etiam scelerisque tellus id ante euismod, vel elementum magna consequat. Donec pulvinar lacus at dui feugiat, vel pretium neque pretium. Donec nec leo quis palabra ligula luctus sollicitudin.";


/**
* Función que relaciona las palabras claves de la descripciónde con la imagen cargada
* Parametros:
* $idfoto : El IDFOTO cargada en la base de datos
* $descripción: String con la descripcion de la foto.
*/
//function wordstag ( $idfoto, $descripcion ){

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
        //echo " ==> ".$updateword."<br>";
      } else {
        $insertword ="INSERT INTO `palabras`( `DESCRIPCION`, `NUMERO`) VALUES ('$value', '0')";
        //echo " ==> ".$insertword."<br>";
        $resultinsertword = mysqli_query($cnx, $insertword);
        $idword = mysqli_insert_id($cnx);
      }

      $consulta = "INSERT INTO `fotospalabras`(`FKTOTO`, `FKPALABRA`) VALUES ('$idfoto','$idword' )";
      $resultado = mysqli_query($cnx, $consulta);
      //echo " ====> ".$idword."<br>";
    }
  }
  //return $msg;
  //echo "<hr>";
  //exit();
  //echo "<hr>";
  //print("<pre>".print_r($palabras,true)."</pre>");
//}
?>
