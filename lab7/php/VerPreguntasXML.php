<?php
    if(!isset($_SESSION)) 
        session_start();  
    if(!($xml = simplexml_load_file("../xml/preguntas.xml"))) {
        echo "<p>Error: se han guardado los datos en el fichero XML. Pulsa el boton para ver las preguntas generadas.</p>";
		echo '<a href="VerPreguntasXML.php">Ver preguntas en XML</a>';
    }
	echo '<table border="0" style="text-align:center;" cellpadding="0" cellspacing="3"><tr>
			                <td width="15%">Enunciado</td>
			                <td width="2%">Complejidad</td>
			                <td width="10%">Tema</td>
			                </tr>';
    foreach($xml->children() as $assessmentItem) {
        echo '<tr class="tabla_datos">';        
        $itemBody = $assessmentItem->children()[0]->children();
    	echo "<td>$itemBody</td>";
        $atributos = $assessmentItem->attributes();
        echo '<td width="15%">'.$atributos[0].'</td>';
        echo '<td width="10%">'.$atributos[1].'</td></tr>';
    }
?>