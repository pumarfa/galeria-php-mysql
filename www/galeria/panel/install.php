<?php
//dbuser=dbuser&dbpass=dbpass&dbname=dbname&install=no
//dbuser=db_user_galery&dbpass=M21h0N1iWVdC&dbname=db_galeria&install=no
// GRANT ALL PRIVILEGES ON db_galeria.* TO 'db_user_galery'@'localhost' IDENTIFIED BY 'M21h0N1iWVdC';
/**
* Instalador de las bases de datos de galerias
*/

$consulta=<<<SQL
CREATE TABLE `fotos` (
  `IDFOTO` int(8) NOT NULL,
  `NOMBRE` varchar(100) NOT NULL,
  `DESCRIPCION` text NOT NULL,
  `ARCHIVO` varchar(100) NOT NULL,
  `POSICION` tinyint(3) NOT NULL,
  `ESTADO` tinyint(1) DEFAULT NULL,
  `FECHA_ALTA` datetime NOT NULL,
  `FKGALERIA` tinyint(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `fotos`
  ADD PRIMARY KEY (`IDFOTO`),
  ADD KEY `IDFOTO` (`IDFOTO`),
  ADD KEY `FKGALERIA` (`FKGALERIA`);

ALTER TABLE `fotos`
  MODIFY `IDFOTO` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

CREATE TABLE `galerias` (
  `IDGALERIA` tinyint(3) UNSIGNED NOT NULL,
  `TITULO` varchar(100) DEFAULT NULL,
  `FECHA_ALTA` datetime DEFAULT NULL,
  `DESCRIPCION` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `galerias`
  ADD PRIMARY KEY (`IDGALERIA`),
  ADD KEY `IDGALERIA` (`IDGALERIA`);

ALTER TABLE `galerias`
  MODIFY `IDGALERIA` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

CREATE TABLE `palabras` (
  `IDPALABRA` int(11) NOT NULL,
  `DESCRIPCION` varchar(50) DEFAULT NULL,
  `NUMERO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `palabras`
  ADD PRIMARY KEY (`IDPALABRA`);

ALTER TABLE `palabras`
  MODIFY `IDPALABRA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

CREATE TABLE `fotospalabras` (
  `IDFP` int(11) NOT NULL,
  `FKFOTO` int(11) NOT NULL,
  `FKPALABRA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `fotospalabras`
  ADD PRIMARY KEY (`IDFP`),
  ADD KEY `FKFOTO` (`FKFOTO`),
  ADD KEY `FKPALABRA` (`FKPALABRA`);

ALTER TABLE `fotospalabras`
  MODIFY `IDFP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

COMMIT
SQL;

echo 'Versión actual de PHP: ' . phpversion().'<br>';
$servername = "mysql";
if ( isset( $_GET['dbuser'] ) && isset( $_GET['dbpass'] ) && isset( $_GET['dbname'] )){
  echo "Los datos de conexión OK: <br>";
  echo "dbuser:".$_GET['dbuser']."<br>";
  echo "dbpass:".$_GET['dbpass']."<br>";
  echo "dbname:".$_GET['dbname']."<br>";
  echo "<br>";
  if (isset( $_GET['install'] ) && $_GET['install'] == 'yes' ) {
    $cnx = mysqli_connect( $servername, $_GET['dbuser'], $_GET['dbpass'], $_GET['dbname'] );
    /*
     * Esta es la forma OO "oficial" de hacerlo,
     * AUNQUE $connect_error estaba averiado hasta PHP 5.2.9 y 5.3.0.
     */
    if ($mysqli->connect_error) {
        die('Error de Conexión (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
    echo $consulta.'<hr>';

    $filas1 = mysqli_query( $cnx, $consulta );
  } else {
    $mysqli = new mysqli( $servername, $_GET['dbuser'], $_GET['dbpass'], $_GET['dbname'] );
    /*
     * Esta es la forma OO "oficial" de hacerlo,
     * AUNQUE $connect_error estaba averiado hasta PHP 5.2.9 y 5.3.0.
     */
    if ($mysqli->connect_error) {
        die('Error de Conexión (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
    echo "Connected successfully";
  }
} else {
    echo '<h2>ERROR:</h2><br /><p>No ha pasado los parametros de Instalación.</p>';
}

//header("Location: index.php");
?>
