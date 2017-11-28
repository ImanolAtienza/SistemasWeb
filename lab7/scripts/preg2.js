$(document).ready(function () {
    var validPass = false;
    var validCor = false;
	botonActivar();
    // Evalua el formulario, si hay error lo notifica
    $("#btnSubmitRegistrar").click(function () {
        var expr = /(^[a-z]+)([0-9]{3})\@ikasle\.ehu\.(es|eus)/;
        var expr1 = /^([a-zA-Z])+/;
        var expr2 = /^([a-zA-Z])+ ([a-zA-Z])+/;
        var vacio = "No se puede dejar ningun campo vacio.";
        var formato = "Debe de tener el siguiente formato: letra+apellido+3digtos+@ikasle.ehu.(es o eus).";
        var formato2 = "Error en formato del nick"
        var valores = "Las contraseñas no coinciden.";

        if($("#mail").val() == "" || !expr.test($("#mail").val())) {
            crearError(vacio + " " + formato);
            return false;
        }

        if($("#nick").val() == "" || !expr1.test($("#nick").val())) {
            crearError(vacio + " " + formato2);
            return false;
        }

        if($("#nomyap").val() == "" || !expr2.test($("#nomyap").val())) {
            crearError(vacio + " " + formato2);
            return false;
        }

        if($("#pass1").val() == "" || $("#pass2").val() == "" || $("#pass1").val() !== $("#pass2").val()) {
            crearError(vacio + " " + valores);
            return false;
        }

        return true;
    });

    //
    $("#mail").change(function() {
        $.ajax({
            data:  {email : $("#mail").val()},
            url:   '../php/CheckEmail.php',
            type:  'post',
            beforeSend: function () {
                crearError("Mirando...");
                console.log('llamada');
            },
            success:  function (response) {
                console.log(response);
                if (response === "SI") {
                    validCor = true;
                    $("#pErr").replaceWith("<p id='pErr'>Mail Ok</p>");
                }
                else {
                    validCor = false;
                    $("#pErr").replaceWith("<p id='pErr'>Mail Caca</p>");
                }
                botonActivar();
            }
        });
    });

    //
    $("#pass2").change(function() {
        $.ajax({
            data:  {pass2 : $("#pass2").val()},
            url:   '../php/CheckPass.php',
            type:  'post',
            beforeSend: function () {
                crearError("Mirando...");
            },
            success:  function (response) {
                console.log(response);
                if (response === "VALIDA") {
                    validPass = true;
                    $("#pErr").replaceWith("<p id='pErr'>Contraseña Correcta</p>");
                }else {
                    validPass = false;
                    $("#pErr").replaceWith("<p id='pErr'>Contraseña Caca</p>");
                }
                botonActivar();
            }
        });
        
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
    function crearError(str1) {
        var error = $("#fpreguntas").find("#pErr");

        if(error.length <= 0) {
            error = $('<p></p>');
            error.attr("id", "pErr");
            $("#fpreguntas").before(error);
        }

        error.text(str1);
    }

    function botonActivar() {
    	console.log(validPass);
    	console.log(validCor);
        if(validPass == true && validCor == true) {
            $("#btnSubmitRegistrar").prop('disabled', false);
            return true;
        }else{
        	$("#btnSubmitRegistrar").prop('disabled', true);
            return false;
        }
    }

});
