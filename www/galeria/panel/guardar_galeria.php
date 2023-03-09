<?php // Panel 

include "../config.php";

$titulo = $_POST[ 'titulo'];
$descripcion = $_POST['descripcion'];

$consulta =<<<SQL
INSERT INTO
    galerias
SET
    TITULO='$titulo',
    DESCRIPCION='$descripcion',
    FECHA_ALTA= NOW()
SQL;

//echo $consulta;

mysqli_query($cnx, $consulta);

header("Location: index.php")
?>
