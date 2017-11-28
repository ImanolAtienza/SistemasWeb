<?php session_start(); ?>
<?php 
	if($_SESSION['rol'] == "0") {
		header("Location: RevisarPreguntas.php");
		exit();
	}
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
    <script type="text/javascript" src="../scripts/preg.js"></script>
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		   		<span class="right"><?php echo($_SESSION['email']);?> logeado</span>
      			<span class="right"><a href="logout.php" id="logout">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Inicio</a></span>
		<span><a href='preguntas.php'>Preguntas</a></span>
		<span><a href='GestionPreguntas.php'>Gestionar preguntas</a></span>
		<span><a href='creditos.php'>Creditos</a></span>
	</nav>
    <section class="main" id="s1">
    
		<div>
			<?php if(isset($_SESSION['email'])){
			    $value=$_SESSION['email'];			
    		    $disabled = "readonly";
		    }?>
			<form id='fpreguntas' name='fpreguntas' method='POST' enctype='multipart/form-data' >
					Dirección de correo electronico*: <input type="text" id="txCor" name="correo" readonly="<?php echo($disabled);?>" value = "<?php echo (isset($value))?$value:'';?>" /><br>
					Enunciado de la pregunta*: <input type="text" id="txEnu" name="enunciado" /><br>
					Respuesta correcta*: <input type="text" id="txOk" name="Ok" /><br>
					Primera respuesta incorrecta*: <input type="text" id="txMal1" name="mal1" /><br>
					Segunda respuesta incorrecta*: <input type="text" id="txMal2" name="mal2" /><br>
					Tercera respuesta incorrecta*: <input type="text" id="txMal3" name="mal3" /><br>
					Complejidad de la pregunta (1-5)*: <input type="number" id="nuComp" name="iComp" /><br>
					Tema de la pregunta*: <input type="text" id="txTem" name="iTema" /><br>
		        <input type="button" id="btnSubmit" value="Submit Form" onClick='pedirDatos(txCor.value,txEnu.value, txOk.value, txMal1.value, txMal2.value, txMal3.value, nuComp.value, txTem.value)'><br>
		    </form>
		    
		</div>
			
		<!--<input type="button" id="btnSubmit" value="Ver preguntas" onClick='visualizarFichero()'><br>-->
		<div id='visualizarPreguntar'>
		    
		</div>
	
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com/set92/servicesWebProject'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
