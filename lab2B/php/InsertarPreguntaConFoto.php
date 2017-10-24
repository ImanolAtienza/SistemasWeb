<?php
	include "configurar.php";

	if(!($bdPreguntas = mysqli_connect($host, $user, $pass, $bd))) 
		 die("Fallo al conectar a MySQL: " . $bdPreguntas->connect_error);
	
	// Si la imagen no esta vacia y que sea de unos tipos determinados
	if($_FILES["imagen"]["size"] > 0 && in_array($_FILES["imagen"]["type"], array("image/jpg", "image/jpeg", "image/png"))) {
		// Escapamos los caracteres para que se puedan almacenar en la base de datos correctamente.
		$foto = mysqli_real_escape_string($bdPreguntas, file_get_contents($_FILES["imagen"]["tmp_name"]));
	} else 
		$foto = mysqli_real_escape_string($bdPreguntas, file_get_contents("../imagenes/fondoDefecto.jpg"));

	$sql = "INSERT INTO preguntas (correo, enunciado, resCorrecta, resMal1, resMal2, resMal3, complejidad, tema, imgRelacionada) VALUES ('".$_POST["correo"]."', '".$_POST["enunciado"]."', '".$_POST["Ok"]."', '".$_POST["mal1"]."', '".$_POST["mal2"]."', '".$_POST["mal3"]."', '".$_POST["complejidad"]."', '".$_POST["tema"]."', '".$foto."')";

	if(!mysqli_query($bdPreguntas, $sql)) {
		echo "<p>Error: $sql</p><br><p>$bdPreguntas->error</p>";
		echo '<a href="javascript:window.history.back();">Volver</a>';
	} else {
		echo "<p>Correcto: se han guardado los datos correctamente. Pulsa el boton para ver las preguntas generadas.</p>";
		echo '<a href="VerPreguntasConFoto.php">Volver</a>';
	}

	mysqli_close($bdPreguntas);
?>