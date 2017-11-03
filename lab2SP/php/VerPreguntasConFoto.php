<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='../estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='../estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='../estilos/smartphone.css' />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--	<script type="text/javascript" src="scripts/preg.js"></script> -->
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<h2>Quiz: el juego de las preguntas</h2>
		<span class="right"><?php echo($_GET['email']);?> logeado</span>
        <span class="right"><a href="../html/layout.html" onclick="javascript:alert("Te has deslogeado");">Logout</a></span>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php?email=<?php echo $_GET['email']?>'>Inicio</a></spam>
		<span><a href='preguntas.php?email=<?php echo $_GET['email']?>'>Preguntas</a></spam>
		<span><a href='creditos.php?email=<?php echo $_GET['email']?>'>Creditos</a></spam>
	</nav>
    <section class="main" id="s1">
        	<div>
				<?php
					include "configurar.php";
				
					$sql = "SELECT * FROM preguntas ORDER BY id ASC";
				
					if(!($bdPreguntas = mysqli_connect($host, $user, $pass, $bd))) 
						die("Fallo al conectar a MySQL: " . $bdPreguntas->connect_error);
				
					if(!($resultado = mysqli_query($bdPreguntas, $sql))) {
						echo "<p>Error: $sql</p><br><p>$bdPreguntas->error</p>";
						echo '<a href="layout.php">Volver</a>';
					} else {
						echo '<table border="0" style="text-align:center;" cellpadding="0" cellspacing="3"><tr>
				                <td width="2%">Id</td>
				                <td width="10%">Email</td>
				                <td width="15%">Enunciado</td>
				                <td width="10%">Correcta</td>
				                <td width="10%">Incorrecta 1</td>
				                <td width="10%">Incorrecta 2</td>
				                <td width="10%">Incorrecta 3</td>
				                <td width="2%">Comp</td>
				                <td width="10%">Tema</td>
				                <td width="10%">Foto</td>              
				                </tr>';
				
						while($fila = mysqli_fetch_array($resultado)) {
							echo '<tr class="tabla_datos">';
							for ($i=1; $i < $resultado->field_count-1; $i++) { 
								echo "<td>$fila[$i]</td>";
							}
							echo '<td><img src="data:image/png;base64,'.base64_encode($fila[$i]).'"width="100px" height="100px"/></td>';
							echo "</tr>";
							
						}
						echo '</table>';
					}
				
					echo '<br><br><a href="layout.php?email='.$_GET['email'].'>Volver</a>';
				
					mysqli_close($bdPreguntas);
				?>
        	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com/ImanolAtienza'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
