<?php //Fotos Galeria
include "../config.php";

$idgaleria = $_GET['id'];

$consulta =<<<SQL
SELECT
    IDFOTO,
    NOMBRE,
    DESCRIPCION,
    ARCHIVO,
    POSICION,
    DATE_FORMAT (FECHA_ALTA, '%d/ %m/ %Y - %H:%i') as FECHA_ALTA,
    ESTADO
FROM
    fotos
WHERE
    FKGALERIA = '$idgaleria'
ORDER BY
    POSICION
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
  					<li><a href="nueva_galeria.php"><span class="icon solid fa-camera-retro"><span class="label">Shoot</span></span></a></li>
  					<li><a href="index.php"><span class="icon solid fa-sync"><span class="label">Process</span></span></a></li>
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
            <form id="fotos" method="post" action="fotos_ordenar.php">
            <div class="table-wrapper">
              <form id="fotos" method="post" action="fotos_ordenar.php"><?php
            	$cantidad = 0;
            	while( $columna = mysqli_fetch_assoc( $filas )){
            	    $cantidad++;
                  echo '<section class="spotlight">';
            			echo '<div class="image"><img src="../images/'.$columna['ARCHIVO'].'" alt="'.$columna['NOMBRE'].'" /></div>';
            			echo '<div class="content">';
            			echo '<h3>'.$columna['NOMBRE'].'</h3>';
            			echo '<p>'.nl2br($columna['DESCRIPCION']).'</p>';
                  echo "<p>Alta: $columna[FECHA_ALTA]</p>";
                  echo '<ul class="actions small">';
                  echo '<li><a href="#" id="Subir" class="button primary small">Subir</a></li>';
                  echo '<li><a href="#" id="Bajar" class="button small">Bajar</a></li>';
                  echo '</ul>';
                  echo '<select name="estado[]" id="demo-category"><option value="1">Visible</option><option value="0" ';
                  if ( $columna['ESTADO'] == 0 ){ echo 'selected="selected"'; };
                  echo '>Invisible</option><option value="2">Borrar</option></select>';
                  echo '<input type="hidden" name="posicion[]" value="'.$columna['IDFOTO'].'"/>';
                  echo '<input type="hidden" name="archivo[]" value="'.$columna['ARCHIVO'].'"/>';
            			echo '</div>';
            			echo '</section>';
            	}
            	?><input type="submit" id="guardar_posicion" value="Guardar Cambios"/>
              <input type="hidden" name="idgaleria" value="<?php echo $idgaleria; ?>"/></form>

            	<script type="text/javascript">

            	var form = document.getElementById('fotos');
            	var sections = form.getElementsByTagName('section');
            	for ( var i = 0; i < sections.length; i++ ){
            	    var botones = sections[i].getElementsByTagName('a');
            	    var btn_subir = botones[0];
            	    var btn_bajar = botones[1];

            	        btn_subir.onclick = function() {
            	            var section = this.parentNode.parentNode.parentNode.parentNode;
            	            var anterior = section.previousSibling;
            	            if( anterior != null ) {
            	                section.parentNode.insertBefore( section, anterior);
            	            }
            	        }
            	        btn_bajar.onclick = function() {
                        var section = this.parentNode.parentNode.parentNode.parentNode;
                        var siguiente = section.nextSibling;
                        if( siguiente != null && siguiente.id != 'guardar_posicion') {
                            section.parentNode.insertBefore( siguiente, section);
                        }
            	        }
            	}
            	</script>
            </div>
          </section>
        </div>
        </section>
        <!-- Contenidos aquí -->
          <section id="three" class="wrapper">
      			<div class="inner">
					<section>
						<h4>Panel de Control</h4>
						<h5>Nueva Foto</h5>
            <form method="POST" enctype="multipart/form-data" action="fotos_guardar.php" />
        	    <input type="hidden" name="idgaleria" value="<?php echo $idgaleria ?>" />
        	    <input type="hidden" name="cantidad" value="<?php echo $cantidad; ?>" />

              <div class="row gtr-uniform">

                <div  id="input_file" class="row  gtr-uniform">
                  <div class="col-6 col-12-xsmall">
                    <input type="hidden" name="estado" value="1" />
  									<input type="text" name="nombre[]" id="foto-name" value="" placeholder="Nombre" />
  								</div>

                  <div class="col-6 col-12-xsmall">
  									<input type="file" name="archivo[]" id="foto-file" />
  								</div>

                  <div class="col-12">
  									<textarea name="descripcion[]" id="foto-message" placeholder="Descripcion de la galeria" rows="6"></textarea>
  								</div>
                </div>
                <!-- aqui deberia agregarse los otros bloque de upload -->

								<div class="col-12">
									<ul class="actions">
										<li><input type="submit" value="Agregar Foto" class="primary" /></li>
										<li><input type="button" id="otra_foto" value="+ Foto" /></li>
									</ul>
								</div>

							</div>

              <script type="text/javascript">
                  var boton = document.getElementById('otra_foto');
                      boton.onclick = function(){
                          var div_cont = document.createElement('div');
                              div_cont.className = "row  gtr-uniform";

                          var div_text = document.createElement('div');
                              div_text.className = 'col-6 col-12-xsmall';

                          var input1 = document.createElement('input');
                              input1.type = 'text';
                              input1.name = 'nombre[]';
                              input1.id = 'foto-name';
                              input1.placeholder='Nombre';

                          var input2 = document.createElement('input');
                              input2.type = 'hidden';
                              input2.name = 'estado[]';
                              input2.value = '1';

                          var div_file = document.createElement('div');
                              div_file.className = 'col-6 col-12-xsmall';

                          var input3 = document.createElement('input');
                              input3.type = 'file';
                              input3.name = 'archivo[]';
                              input3.id = 'foto-file';

                            var div_desc = document.createElement('div');
                                div_desc.className='col-12';

                            var input4 = document.createElement('textarea');
                                input4.rows = '5';
                                input4.name = 'descripcion[]';
                                input4.id='foto-message';
                                input4.placeholder='Descripcion de la galeria';

                            var div = document.getElementById('input_file');

                                div_text.appendChild(input1);
                                div_text.appendChild(input2);
                                div_file.appendChild(input3);
                                div_desc.appendChild(input4);

                              div_cont.appendChild(div_text);
                              div_cont.appendChild(div_file);
                              div_cont.appendChild(div_desc);
                              div.appendChild(div_cont);
                      }
              </script>
						</form>
					</section>
        </div>
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
