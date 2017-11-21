<?php
	
	$bdPreguntas;
	if(isset($_GET['insert']) && ($_GET['insert'] == "1"))
		bdInsertarPregunta();
	else echo "<script>console.log( 'Debug Objects: " . 'insert vacio' . "' );</script>";
	
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
    

	function bdInsertarPregunta() {
	    include "configurar.php";
	    
		$email=$_POST["correo"];
		$enunciado=$_POST["enunciado"];
		$correcta=$_POST["Ok"];
		$inco1=$_POST["mal1"];
		$inco2=$_POST["mal2"];
		$inco3=$_POST["mal3"];
		$comp=$_POST["iComp"];
		$tema=$_POST["iTema"];
		echo "<script>console.log( 'Debug Objects: " . 'valor: '. $inco3 . "//' );</script>";
		
		$bdPreguntas = mysqli_connect($host, $user, $pass, $bd);
		
		// Si la imagen no esta vacia y que sea de unos tipos determinados
		if (!empty($email) && !empty($enunciado)){
			
			$sql = "INSERT INTO preguntas (email, enunciado, correcta, inco1, inco2, inco3, comp, tema) 
			VALUES ('".$email."','".$enunciado."','".$correcta."','".$inco1."','".$inco2."','".$inco3."','".$comp."','".$tema."')";
	
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