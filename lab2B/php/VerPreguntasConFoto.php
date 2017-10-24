<?php
	include "configurar.php";

	$sql = "SELECT * FROM preguntas ORDER BY idPregunta ASC";

	if(!($bdPreguntas = mysqli_connect($host, $user, $pass, $bd))) 
		die("Fallo al conectar a MySQL: " . $bdPreguntas->connect_error);

	if(!($resultado = mysqli_query($bdPreguntas, $sql))) {
		echo "<p>Error: $sql</p><br><p>$bdPreguntas->error</p>";
		echo '<a href="../layout.html">Volver</a>';
	} else {
		echo '<table border="1"><tr><th>Quiz Preguntas</th></tr><tr><td>Correo.</td><td>Enunciado.</td><td>Respuesta correcta</td><td>Incorrecta.</td><td>Incorrecta.</td><td>Incorrecta.</td><td>Complejidad.</td><td>Tema.</td>';

		while($fila = mysqli_fetch_array($resultado)) {
			echo "<tr>";
			for ($i=1; $i < $resultado->field_count-1; $i++) { 
				echo "<td>$fila[$i]</td>";
			}
			echo '<td><img src="data:image/png;base64,'.base64_encode($fila[$i]).'"width="70px" height="70px"/></td>';
			echo "</tr>";
			
		}
		echo '</table>';
	}

	echo '<br><br><a href="../layout.html">Volver</a>';

	mysqli_close($bdPreguntas);
?>
