$(document).ready(function () {
	// Evalua el formulario, si hay error lo notifica
	$("#btnSubmit").click(function () {
			var expr = /(^[a-z]+)([0-9]{3})\@ikasle\.ehu\.(es|eus)/;
			var vacio = "No se puede dejar ningun campo vacio.";
			var formato = "Debe de tener el siguiente formato: letra+apellido+3digtos+@ikasle.ehu.(es o eus).";
			var longitud = "La pregunta de debe contener por lo menos 10 caracteres.";
			var valores = "Los valores deben comprender entre 1 y 5.";

			if($("#txCor").val() == "" || !expr.test($("#txCor").val())) {
				crearError(vacio + " " + formato);
				return false;
			}

			if($("#txEnu").val().length < 9) {
				crearError(longitud);
				return false;
			}

			if($("#txOk").val() == "" || $("#txMal1").val() == "" || $("#txMal2").val() == "" || $("#txMal3").val() == "" || $("#txTem").val() == "") {
				crearError(vacio);
				return false;
			}

			if($("#nuComp").val() < 1 || $("#nuComp").val() > 5 || $("#nuComp").val() == "") {
				crearError(vacio + " " + valores);
				return false;
			}

			return true;
	});
	
	// Crea dinamicamente la imagen que se ha cargado
	$("#imPre").change(function (event) {
		var imagen = $("#fpreguntas").find("#imEjem");
		var salto = $("<br>");
			
		if(imagen.length <= 0) {
			imagen = $('<img id="imEjem" align="center" width="20%" height="20%" />');
			$("#btEnviar").before(imagen);
			imagen.after(salto);
		}

		$("#imEjem").attr("src", URL.createObjectURL(event.target.files[0]));
	});

	// Mira si existe el elemento "p" y le pone el mensaje de error, si no existe, crea el elemento p
	function crearError(str1, str2) {
		var error = $("#fpreguntas").find("#pErr");

		if(error.length <= 0) {
			error = $('<p></p>');
			error.attr("id", "pErr");
			$("#fpreguntas").before(error);
		}

		error.text(str1 + str2);
	}
	
	function visualizarFichero() {
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	        if (this.readyState == 4) {
	            document.getElementById("visualizarPreguntar").innerHTML = this.responseText;
	        }
	    };
	    xmlhttp.open("GET", "VerPreguntasXML.php", true);
	    xmlhttp.send(null);
	}

function pedirDatos(correo, enun, ok, mal1, mal2, mal3, comp, tema){
	alert(correo);
	xmlhttp.open("POST","GestionPreguntas.php?email="+correo+"&insert=1",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("correo="+correo+"&enunciado="+enun+"&Ok="+ok+"&mal1="+mal1+"&mal2&="+mal2+"&mal3="+mal3+"&iComp="+comp+"&iTema="+tema);
	
	visualizarFichero();
}
	
	visualizarFichero();
});
