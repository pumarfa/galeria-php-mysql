<?php // Panel 

include "../config.php";

$id = $_POST['id'];
$titulo = $_POST[ 'titulo'];
$descripcion = $_POST['descripcion'];

$consulta =<<<SQL
UPDATE
    galerias
SET
    TITULO='$titulo',
    DESCRIPCION='$descripcion'
WHERE
    IDGALERIA = '$id'
SQL;

//echo $consulta;

mysqli_query($cnx, $consulta);

header("Location: index.php");
?>
