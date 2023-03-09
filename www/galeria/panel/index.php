<?php // Panel

include "../config.php";

$consulta =<<<SQL
SELECT
    IDGALERIA,
    TITULO,
    DESCRIPCION,
    DATE_FORMAT (FECHA_ALTA, '%d/%m/%Y - %H:%i') as FECHA_ALTA
FROM
    galerias
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
            <h4>Galeria de Fotos</h4>
            <h5>Listado de galerias</h5>
            <div class="table-wrapper">
              <table>
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Descripciónion</th>
                    <th>Fecha</th>
                    <th>Botones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
              		while( $columna = mysqli_fetch_assoc( $filas )){
              		    echo "<tr>";
              		    echo "<td>$columna[TITULO]</td>";
              		    echo "<td>$columna[DESCRIPCION]</td>";
              		    echo "<td>$columna[FECHA_ALTA]</td>";
              		    echo "<td> <a href='editar_galeria.php?id=$columna[IDGALERIA]'>Editar </a>| <a href='borrar_galeria.php?id=$columna[IDGALERIA]'>Borrar</a> |<a href='fotos_galeria.php?id=$columna[IDGALERIA]'> Fotos</a> </td>";
              		    echo "</tr>";
              		}
              		?>
                </tbody>
              </table>
            </div>
          </section>
          <a href="nueva_galeria.php" class="button primary small">Nueva Galeria</a>
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
