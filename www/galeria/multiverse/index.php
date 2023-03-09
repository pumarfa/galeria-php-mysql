<?php // website

include "../config.php";

?>
<!DOCTYPE HTML>
<!--
	Multiverse by HTML5 UP
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

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="../index.php"><strong>VOLVER A </strong> GALERIAS</a></h1>
						<nav>
							<ul>
								<li><a href="#footer" class="icon solid fa-info-circle">About</a></li>
							</ul>
						</nav>
					</header>

				<!-- Main -->
					<div id="main">
						<?php
						if ( isset( $_GET['gal'] )){
				    //Consulta de una galeria especíaifa
				        $id = $_GET['gal'];
				        // Recuperar los datos de la galeria que se esta visualizando
				        $consulta ="SELECT DESCRIPCION, TITULO FROM galerias WHERE IDGALERIA='$id' LIMIT 1";
				        $filas = mysqli_query($cnx, $consulta);
				        $galeriaDesc = mysqli_fetch_assoc( $filas );

								$consulta ="SELECT IDFOTO, NOMBRE, DESCRIPCION, ARCHIVO, POSICION, DATE_FORMAT (FECHA_ALTA, '%d/ %m/ %Y - %H:%i') as FECHA_ALTA, ESTADO FROM fotos WHERE FKGALERIA='$id' AND ESTADO= 1 ORDER BY POSICION";

				        $filas = mysqli_query($cnx, $consulta);
								while( $columna = mysqli_fetch_assoc( $filas )){
									echo '<article class="thumb">';
									echo '<a href="../fotos/'.$columna['ARCHIVO'].'" class="image"><img src="../images/'.$columna['ARCHIVO'].'" alt="" /></a>';
									echo '<h2>'.$columna['NOMBRE'].'</h2>';
									echo '<p>'.nl2br($columna['DESCRIPCION']).'</p>';
									echo '</article>';
								}
							}
						?>
					</div>

				<!-- Footer -->
					<footer id="footer" class="panel">
						<div class="inner split">
							<div>
								<section>
									<?php
									echo '<h2>'.$galeriaDesc['TITULO'].'</h2>';
									echo '<p>'.$galeriaDesc['DESCRIPCION'].'</p>';
									?>
								</section>
								<section>
									<h2>Follow me on ...</h2>
									<ul class="icons">
										<li><a href="https://twitter.com/un_misiones" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="https://www.facebook.com/nexounam" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
										<li><a href="https://www.instagram.com/unam_misiones/?hl=es" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
									</ul>
								</section>
								<p class="copyright">
									&copy; Unttled. Design: <a href="http://html5up.net">HTML5 UP</a>.
								</p>
							</div>
							<div>
								<!--
								<section>
									<h2>Get in touch</h2>
									<form method="post" action="#">
										<div class="fields">
											<div class="field half">
												<input type="text" name="name" id="name" placeholder="Name" />
											</div>
											<div class="field half">
												<input type="text" name="email" id="email" placeholder="Email" />
											</div>
											<div class="field">
												<textarea name="message" id="message" rows="4" placeholder="Message"></textarea>
											</div>
										</div>
										<ul class="actions">
											<li><input type="submit" value="Send" class="primary" /></li>
											<li><input type="reset" value="Reset" /></li>
										</ul>
									</form>
								</section>
							-->
							</div>
						</div>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.poptrox.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
