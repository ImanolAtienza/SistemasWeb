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
      		<span class="right"><?php echo($_GET['email']);?> logeado</span>
      		<span class="right"><a href="../html/layout.html" onclick="javascript:alert("Te has deslogeado");">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php?email=<?php echo($_GET['email']);?>'>Inicio</a></spam>
		<span><a href='preguntas.php?email=<?php echo($_GET['email']);?>'>Preguntas</a></spam>
		<span><a href='creditos.php?email=<?php echo($_GET['email']);?>'>Creditos</a></spam>
	</nav>
    <section class="main" id="s1">
    
	<div>
		<?php if(isset($_GET['email'])){
			$value=$_GET['email'];			
    	$disabled = "readonly";
		}?>
		<form id="fpreguntas" name="fpreguntas" action="InsertarPreguntaConFoto.php?email=<?php echo($_GET['email']);?>" method="post" enctype='multipart/form-data'>
			Dirección de correo electronico*: <input type="text" id="txCor" name="correo" readonly="<?php echo($disabled);?>" 
					value = "<?php echo (isset($value))?$value:'';?>" /><br>
			Enunciado de la pregunta*: <input type="text" id="txEnu" name="enunciado" /><br>
			Respuesta correcta*: <input type="text" id="txOk" name="Ok" /><br>
			Primera respuesta incorrecta*: <input type="text" id="txMal1" name="mal1" /><br>
			Segunda respuesta incorrecta*: <input type="text" id="txMal2" name="mal2" /><br>
			Tercera respuesta incorrecta*: <input type="text" id="txMal3" name="mal3" /><br>
			Complejidad de la pregunta (1-5)*: <input type="number" id="nuComp" name="iComp" /><br>
			Tema de la pregunta*: <input type="text" id="txTem" name="iTema" /><br>
			Imagen relacionada con la pregunta: <input type="file" id="imPre" name="imagen" accept=".png, .jpg, .jpeg"><br>
			<input type="submit" id="btEnviar" value="Enviar"><br>
		</form>
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com/ImanolAtienza'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
