<?php
	include "configurar.php";

	$sql = "INSERT INTO Preguntas (correo, enunciado, resCorrecta, resMal1, resMal2, resMal3, complejidad, tema) VALUES ('".$_POST["correo"]."','".$_POST["enunciado"]."','".$_POST["Ok"]."','".$_POST["mal1"]."', '".$_POST["mal2"]."','".$_POST["mal3"]."','".$_POST["complejidad"]."','".$_POST["tema"]."')";

	if(!($bdPreguntas = mysqli_connect($host, $user, $pass, $bd))) 
		 die("Fallo al conectar a MySQL: " . $bdPreguntas->connect_error);

	if(!mysqli_query($bdPreguntas, $sql)) {
		echo "<p>Error: $sql</p><br><p>$bdPreguntas->error</p>";
		echo '<a href="javascript:window.history.back();">Volver</a>';
	} else {
		echo "<p>Correcto: se han guardado los datos correctamente. Pulsa el boton para ver las preguntas generadas.</p>";
		echo '<a href="VerPreguntas.php">Volver</a>';
	}

	mysqli_close($bdPreguntas);
?>