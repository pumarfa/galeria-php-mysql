<?php // website

include "config.php";

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
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
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
				<div class="image phone"><div class="inner"><img src="img/logo_unam_vertical.png" alt="" /></div></div>
			</header>

		<!-- One -->
			<section id="one" class="wrapper style2 special">
				<header class="major">
					<h2>Galerias de Fotos<br />
					cincuenta años de historia</h2>
				</header>
				<ul class="icons major">
					<li><a href="panel/nueva_galeria.php"><span class="icon solid fa-camera-retro"><span class="label">Shoot</span></span></a></li>
					<li><a href="index.php"><span class="icon solid fa-sync"><span class="label">Process</span></span></a></li>
					<li><a href="index.php"><span class="icon solid fa-cloud"><span class="label">Upload</span></span></a></li>
				</ul>
			</section>

		<!-- Two -->
		<!-- Aqui se despliega el listado de los álbum disponibles -->
			<section id="two" class="wrapper">
				<div class="inner alt">
		<?php
		// Recuperar la lista de los álbum disponibles
		$consulta =<<<SQL
		SELECT
				IDGALERIA,
				TITULO,
				DESCRIPCION,
				DATE_FORMAT (FECHA_ALTA, '%d/ %m/ %Y - %H:%i') as FECHA_ALTA
		FROM
				galerias
		ORDER BY
				FECHA_ALTA DESC
		SQL;
		$filas = mysqli_query($cnx, $consulta);

		while ( $columna = mysqli_fetch_assoc( $filas ) ) {

			$id = $columna['IDGALERIA'];
			$subquery = "SELECT ARCHIVO FROM fotos WHERE FKGALERIA='$id' AND ESTADO= 1 LIMIT 1";
			$filas2 = mysqli_query($cnx, $subquery);
			$foto = mysqli_fetch_assoc( $filas2 );
			$nombre_archivo = $foto['ARCHIVO'];
			echo '<section class="spotlight">';
			echo '<div class="image"><img src="images/'.$nombre_archivo.'" alt="" /></div>';
			echo '<div class="content">';
			echo '<h3>'.$columna['TITULO'].'</h3>';
			echo '<p>'.nl2br($columna['DESCRIPCION']).'</p>';
			echo '<a href="galeria.php?gal='.$id.'" class="button primary fit small">Visitar Galeria</a></li>';
			echo '</div>';
			echo '</section>';
			// code...
		}

		?>


				</div>
			</section>

				</div>
			</section>


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
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
