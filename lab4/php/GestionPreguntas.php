<?php
	include "configurar.php";
	
	$bdPreguntas;
	if($_GET['insert'] == "1")
		insertarPreguntas();
	
	function xml($em,$en,$c,$i1,$i2,$i3,$com,$te){
        $xml = simplexml_load_file('../xml/preguntas.xml');
        if(!isset($xml)) {
            echo "<p>Error: no se han guardado los datos en el fichero XML. Pulsa el boton para ver las preguntas generadas.</p>";
            echo '<a href="VerPreguntasXML.php?email="'.$_GET['email'].'">Ver preguntas en XML</a>';

            return false;
        }
        $pregunta = $xml->addChild('assessmentItem');
        $pregunta->addAttribute('complexity', $com);
        $pregunta->addAttribute('subject', $te);
        $pregunta->addAttribute('author',$em);
        
        $pregunta->addChild('itemBody')->addChild('p', $en);
        
        $pregunta->addChild('correctResponse')->addChild('value', $c);
        $preg_incorrectas = $pregunta->addChild('incorrectResponses');
        $preg_incorrectas->addChild('value', $i1);
        $preg_incorrectas->addChild('value', $i2);
        $preg_incorrectas->addChild('value', $i3);

		$xml->asXML('../xml/preguntas.xml');
		return true;

    }

	function conectarBD() {
		if(!($bdPreguntas = mysqli_connect($host, $user, $pass, $bd))) 
			 die("Fallo al conectar a MySQL: " . $bdPreguntas->connect_error);
			 
	}

	function bdInsertarPregunta() {
		$email=$_POST["correo"];
		$enunciado=$_POST["enunciado"];
		$correcta=$_POST["Ok"];
		$inco1=$_POST["mal1"];
		$inco2=$_POST["mal2"];
		$inco3=$_POST["mal3"];
		$comp=$_POST["iComp"];
		$tema=$_POST["iTema"];
		$foto=$_FILES["imagen"];
		
		conectarBD();
		
		// Si la imagen no esta vacia y que sea de unos tipos determinados
		if (!empty($email) && !empty($enunciado) && !empty($correcta) && !empty($inco1) && !empty($inco2) && !empty($inco3)
		&& !empty($comp) && !empty($tema) && !empty($foto) && preg_match('/^[1-5]$/', $comp) && preg_match('/^[a-z]+[0-9]{3}\@ikasle\.ehu\.(es|eus)/', $email)){
			if($foto["size"] > 0 && in_array($_FILES["imagen"]["type"], array("image/jpg", "image/jpeg", "image/png"))) {
				// Escapamos los caracteres para que se puedan almacenar en la base de datos correctamente.
				$foto = mysqli_real_escape_string($bdPreguntas, file_get_contents($foto["tmp_name"]));
			} else 
				$foto = mysqli_real_escape_string($bdPreguntas, file_get_contents("../imagenes/fondoDefecto.jpg"));
	
			$sql = "INSERT INTO $bd.preguntas (email, enunciado, correcta, inco1, inco2, inco3, comp, tema, image) 
			VALUES ('".$email."','".$enunciado."','".$correcta."','".$inco1."',
		    '".$inco2."','".$inco3."','".$comp."','".$tema."','".$foto."')";
	
		    if(mysqli_query($bdPreguntas, $sql) && xml($email, $enunciado, $correcta, $inco1, $inco2, $inco3, $comp, $tema)){
	            echo "<p>Correcto: se han guardado los datos en la base de datos. Pulsa el boton para ver las preguntas generadas.</p>";
	            echo '<a href="VerPreguntasConFoto.php?email="'.$_GET['email'].'">Ver preguntas</a>';
	
	            echo "<p>Correcto: se han guardado los datos en el fichero XML. Pulsa el boton para ver las preguntas generadas.</p>";
	            echo '<a href="VerPreguntasXML.php?email="'.$_GET['email'].'">Ver preguntas en XML</a>';
			} else {
	            echo "<p>Error: $sql->conn</p><br><p>$bdPreguntas->error</p>";
	            echo '<a href="javascript:window.history.back();">Volver</a>';
			}
		} else {
			echo "<p>Error: Alguno de los campos no cumple la validacion.</p>";
			echo '<a href="javascript:window.history.back();">Volver</a>';
		}
	
		mysqli_close($bdPreguntas);		
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
		   		<span class="right"><?php echo($_GET['email']);?> logeado</span>
      		<span class="right"><a href="../html/layout.html" onclick="javascript:alert("Te has deslogeado");">Logout</a></span>
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
			
			<form id='fpreguntas' name='fpreguntas' method='POST' enctype='multipart/form-data' >
					Dirección de correo electronico*: <input type="text" id="txCor" name="correo" value="<?php echo $_GET['email']?>" readonly="<?php echo($disabled);?>" 
					value = "<?php echo (isset($value))?$value:'';?>" /><br>
					Enunciado de la pregunta*: <input type="text" id="txEnu" name="enunciado" /><br>
					Respuesta correcta*: <input type="text" id="txOk" name="Ok" /><br>
					Primera respuesta incorrecta*: <input type="text" id="txMal1" name="mal1" /><br>
					Segunda respuesta incorrecta*: <input type="text" id="txMal2" name="mal2" /><br>
					Tercera respuesta incorrecta*: <input type="text" id="txMal3" name="mal3" /><br>
					Complejidad de la pregunta (1-5)*: <input type="number" id="nuComp" name="iComp" /><br>
					Tema de la pregunta*: <input type="text" id="txTem" name="iTema" /><br>
		        <input type="button" id="btnSubmit" value="Submit Form" onClick='pedirDatos(<?php $_GET['email']?>,txCor.value(),txEnu.value(), txtOk.value(), txMal1.value(), txMal2.value(), txMal3.value(), nuComp.value(), txTem.value())'><br>
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