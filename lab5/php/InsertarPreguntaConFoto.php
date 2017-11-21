<?php
	include "configurar.php";
	
	function xml($em,$en,$c,$i1,$i2,$i3,$com,$te){
        $xml = simplexml_load_file('../xml/preguntas.xml');
        if(!isset($xml)) {
            echo "<p>Error: no se han guardado los datos en el fichero XML. Pulsa el boton para ver las preguntas generadas.</p>";
            echo '<a href="VerPreguntasXML.php?email="'.$_GET['email'].'">Ver preguntas en XML</a>';

            return false;
        }
        $pelicula = $xml->addChild('assessmentItem');
        $pelicula->addAttribute('complexity', $com);
        $pelicula->addAttribute('subject', $te);
        $pelicula->addAttribute('author',$em);
        
        $pelicula->addChild('itemBody')->addChild('p', $en);
        
        $pelicula->addChild('correctResponse')->addChild('value', $c);
        $preg_incorrectas = $pelicula->addChild('incorrectResponses');
        $preg_incorrectas->addChild('value', $i1);
        $preg_incorrectas->addChild('value', $i2);
        $preg_incorrectas->addChild('value', $i3);

		$xml->asXML('../xml/preguntas.xml');
		return true;

    }

	if(!($bdPreguntas = mysqli_connect($host, $user, $pass, $bd))) 
		 die("Fallo al conectar a MySQL: " . $bdPreguntas->connect_error);
	
	$email=$_POST["correo"];
	$enunciado=$_POST["enunciado"];
	$correcta=$_POST["Ok"];
	$inco1=$_POST["mal1"];
	$inco2=$_POST["mal2"];
	$inco3=$_POST["mal3"];
	$comp=$_POST["iComp"];
	$tema=$_POST["iTema"];
	$foto=$_FILES["imagen"];
	
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
?>