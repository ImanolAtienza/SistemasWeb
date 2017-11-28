<?php
    if(!isset($_SESSION)) 
        session_start();  
?>
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
  <script type="text/javascript" src="../scripts/preg2.js"></script>
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		   		<span class="right"><?php if(isset($_SESSION['email'])) echo($_SESSION['email']);?> logeado</span>
      			<span class="right"><a href="logout.php" id="logout">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Inicio</a></span>
		<span><a href='preguntas.php'>Preguntas</a></span>
<?php
	if($_SESSION['rol'] == "1")
		echo "<span><a href='GestionPreguntas.php'>Gestionar preguntas</a></span>";
	elseif ($_SESSION['rol'] == "0") {
		echo "<span><a href='RevisarPreguntas.php'>Revisar preguntas</a></span>";
	}
?>
		<span><a href='creditos.php'>Creditos</a></span>
	</nav>
    <section class="main" id="s1">

	<div>
	Aqui se visualizan las preguntas y los creditos ...
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com/set92/servicesWebProject'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
