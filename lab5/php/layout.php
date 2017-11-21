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
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		   		<span class="right"><?php echo($_GET['email']);?> logeado</span>
      		<span class="right"><a href="../html/layout.html" onclick='javascript:alert("Te has deslogeado");'>Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php?email=<?php echo $_GET['email']?>'>Inicio</a></span>
		<span><a href='preguntas.php?email=<?php echo $_GET['email']?>'>Preguntas</a></span>
		<span><a href='VerPreguntasConFoto?email=<?php echo $_GET['email']?>'>Ver preguntas</a></span>
		<span><a href='GestionPreguntas.php?email=<?php echo $_GET['email']?>'>Gestionar preguntas</a></span>
		<span><a href='creditos.php?email=<?php echo $_GET['email']?>'>Creditos</a></span>
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
