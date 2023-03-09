<?php
/**
 * ConfiguraciÃn inicial de conexion a la base de datos
 * GRANT ALL PRIVILEGES ON db_galeria.* TO 'db_user_galery'@'localhost' IDENTIFIED BY 'M21h0N1iWVdC';
 *
 * */

$servername = "mysql"; //Se usa el nombre con el que se declara en docker-compose.yml el servidor MySQL.
$username = "db_user_galery";
$password = "M21h0N1iWVdC";
$dbname = "db_galeria";

$cnx = mysqli_connect( $servername, $username, $password, $dbname);

if ($cnx->connect_error) {
  die("Connection failed: " . $cnx->connect_error);
}

$mesage =null;
?>
