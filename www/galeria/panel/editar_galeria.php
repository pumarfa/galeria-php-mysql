<?php // Panel

include "../config.php";

$id = $_GET['id'];

$consulta =<<<SQL
SELECT
    IDGALERIA,
    TITULO,
    DESCRIPCION
FROM
    galerias
WHERE
    IDGALERIA = '$id'
LIMIT 1
SQL;

$filas = mysqli_query($cnx, $consulta);
$columnas = mysqli_fetch_assoc($filas);

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
				<p>Una galeria de fotos donde se recopial la hisoria de la Universidad Nacional de Misiones <a href="http://www.unam.edu.ar">UNaM</a></p>
				<ul class="actions">
					<li><a href="#one" class="button icon solid fa-chevron-down scrolly">Galerias</a></li>
				</ul>
			</div>
			<div class="image phone"><div class="inner"><img src="../images/logo_unam_vertical.png" alt="" /></div></div>
		</header>

    		<!-- One -->
    			<section id="one" class="wrapper style2 special">
    				<header class="major">
    					<h2>Galerias de Fotos<br />
    					cincuenta años de historia</h2>
    				</header>
    				<ul class="icons major">
    					<li><a href="nueva_galeria.php"><span class="icon solid fa-camera-retro"><span class="label">Shoot</span></span></a></li>
    					<li><a href="index.php"><span class="icon solid fa-sync"><span class="label">Process</span></span></a></li>
    					<li><a href="../index.php"><span class="icon solid fa-cloud"><span class="label">Upload</span></span></a></li>
    				</ul>
    			</section>

        </div>
			</section>

      <!-- Four -->

  		<section id="four" class="wrapper">
  			<div class="inner">
          <!-- Contenidos aquí -->
					<section>
            <h4>Panel de Control</h4>
            <h5>Editar Galeria</h5>
						<form method="post" action="update_galeria.php">
              <input type="hidden" name="id" value="<?php echo $columnas['IDGALERIA']?>">
							<div class="row gtr-uniform">
								<div class="col-6 col-12-xsmall">
									<input type="text" name="titulo" id="demo-name" value="<?php echo $columnas['TITULO']?>" placeholder="Nombre" />
								</div>
								<div class="col-12">
									<textarea name="descripcion" id="demo-message" placeholder="Descripcion de la galeria" rows="6"><?php echo $columnas['DESCRIPCION']?></textarea>
								</div>
								<div class="col-12">
									<ul class="actions">
										<li><input type="submit" value="Editar Galeria" class="primary" /></li>
										<li><input type="reset" value="Reset" /></li>
									</ul>
								</div>
							</div>
						</form>
					</section>
          <!-- FIN Contenidos aquí -->
        </div>
      </section>
		<!-- Footer -->
			<footer id="footer">
				<ul class="icons">
          <li><a href="https://www.facebook.com/nexounam" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
					<li><a href="https://twitter.com/un_misiones" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="https://www.instagram.com/unam_misiones/?hl=es" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
				</ul>
				<p class="copyright">&copy; Untitled. Credits: <a href="http://html5up.net">HTML5 UP</a></p>
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
