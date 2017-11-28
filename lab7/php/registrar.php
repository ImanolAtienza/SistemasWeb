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
	    <span class="right"><a href="login.php">Login</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='../html/layout.html'>Inicio</a></spam>
		<span><a href='../html/preguntas.html'>Preguntas</a></spam>
		<span><a href='../html/creditos.html'>Creditos</a></spam>
	</nav>
    <section class="main" id="s1">
    
	<div>
	    
	    
<form id='fpreguntas' name='fpreguntas' method='POST' enctype='multipart/form-data' action='InsertarRegistro.php'>
    Email*: <input type="text" name="email" id="mail">                                <br>
    Nombre y apellidos*: <input type="nombre" name="nombre" id="nomyap">                         <br>
    Nick*: <input type="text" id="nick" name="nick" >   <br>
    Password*: <input type="text" id="pass1" name="pass1" >   <br>
    Repetir Password*: <input type="text" id="pass2" name="pass2">   <br>
    Insertar imagen (Max 64Kb): <input type="file" name="image" size="40" accept="image/*" onchange="loadFile(event)"> <br>
    <img id="output" align="center"/> <br>
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            $('img#output').css({'width':'30%', 'height':'30%'});
        };
    </script>
    <input type="submit" id="btnSubmitRegistrar" value="Submit Form">                                <br>
    <p id="pErr"></p>
</form>


	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com/set92/servicesWebProject'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
