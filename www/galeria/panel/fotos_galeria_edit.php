<?php //Fotos Galeria
include "../config.php";

$idfoto = $_GET['idfoto'];
$idgaleria = $_GET['id'];

$consulta =<<<SQL
SELECT
    IDFOTO,
    NOMBRE,
    DESCRIPCION,
    ARCHIVO,
    POSICION,
    FECHA_ALTA,
    ESTADO,
    FKGALERIA
FROM
    fotos
WHERE
    IDFOTO = '$idfoto'
LIMIT 1
SQL;

$filas = mysqli_query($cnx, $consulta);

?>
<!DOCTYPE HTML>
<!--
	Fractal by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>50 años - Galeria de Fotos</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

	<!-- Header -->
		<header id="header">
			<div class="content">
				<h1><a href="#">Galeria 50 AÑOS</a></h1>
        <p>Una galeria de fotos donde se recopila la historia de la Universidad Nacional de Misiones <a href="http://www.unam.edu.ar">UNaM</a></p>
				<ul class="actions">
					<li><a href="#one" class="button icon solid fa-chevron-down scrolly">Galerias</a></li>
				</ul>
			</div>
			<div class="image phone"><div class="inner"><img src="../img/logo_unam_vertical.png" alt="" /></div></div>
		</header>

  		<!-- One -->
  			<section id="one" class="wrapper style2 special">
  				<header class="major">
  					<h2>Galerias de Fotos<br />
  					cincuenta años de historia</h2>
  				</header>
  				<ul class="icons major">
  					<li><a href="nueva_galeria.php#one"><span class="icon solid fa-camera-retro"><span class="label">Shoot</span></span></a></li>
  					<li><a href="index.php#one"><span class="icon solid fa-sync"><span class="label">Process</span></span></a></li>
  					<li><a href="../index.php"><span class="icon solid fa-cloud"><span class="label">Upload</span></span></a></li>
  				</ul>
  			</section>

      <!-- Four -->

  		<section id="two" class="wrapper">
  			<div class="inner">
          <!-- Contenidos aquí -->
          <section>
            <h4>Panel de Control</h4>
            <h5>Galería <?php echo $idgaleria; ?></h5>
            <form id="fotos" method="post" action="foto_guardar.php">
            <div class="table-wrapper">
              <form id="fotos" method="post" action="fotos_ordenar.php"><?php
            	while( $columna = mysqli_fetch_assoc( $filas )){
                    echo '<section class="spotlight">';
            	    echo '<div class="image"><a href=""><img src="../images/'.$columna['ARCHIVO'].'" alt="'.$columna['NOMBRE'].'" /></a></div>';
            	    echo '<div class="content">';
            	    echo '<h3>'.$columna['NOMBRE'].'</h3>';
                    echo '<p>Descripcion: <textarea name="descripcion" id="foto-message" placeholder="Descripcion de la galeria" rows="6">'.$columna['DESCRIPCION'].'</textarea></p>';
                    echo "<p>Alta: $columna[FECHA_ALTA]</p>";
                    echo '<ul class="actions small">';
                    echo '</ul>';
                    echo '<select name="estado" id="demo-category"><option value="1">Visible</option><option value="0" ';
                    if ( $columna['ESTADO'] == 0 ){ echo 'selected="selected"'; };
                    echo '>Invisible</option><option value="2">Borrar</option></select>';
                    echo '<input type="hidden" name="idfoto" value="'.$columna['IDFOTO'].'"/>';
                    echo '<input type="hidden" name="archivo" value="'.$columna['ARCHIVO'].'"/>';
            	    echo '</div>';
                    echo '</section>';
                    echo '<input type="hidden" name="idgaleria" value="'.$columna['FKGALERIA'].'"/>';
;
            	}
            	?><input type="submit" id="guardar_posicion" value="Guardar Cambios"/>
              </form>
            </div>
          </section>
        </div>
        </section>
        <!-- Contenidos aquí -->
        </section>
          <!-- FIN Nueva fotos -->
          <!-- FIN Contenidos aquí -->

		<!-- Footer -->
			<footer id="footer">
				<ul class="icons">
          <li><a href="https://www.facebook.com/nexounam" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
					<li><a href="https://twitter.com/un_misiones" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="https://www.instagram.com/unam_misiones/?hl=es" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
				</ul>
        <p class="copyright">&copy; Universidad Nacional de Misiones 2023. Credits: <a href="http://html5up.net">HTML5 UP</a></p>
			</footer>

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/jquery.scrolly.min.js"></script>
			<script src="../assets/js/browser.min.js"></script>
			<script src="../assets/js/breakpoints.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>

	</body>
</html>
