$(document).ready(function () {
    
	visualizar = function visualizarFichero() {
	    let searchParams = new URLSearchParams(window.location.search)
	    var param = searchParams.get('id');
        $.ajax({
            data:  {id: param},
            url:   '../php/mandarPreguntasAjax.php?insert=2',
            type:  'post',
            success:  function (response) {
                pregs = response.split('*=*');
                $("#txCor").val(pregs[1]);
                $("#txEnu").val(pregs[2]);
                $("#txOk").val(pregs[3]);
                $("#txMal1").val(pregs[4]);
                $("#txMal2").val(pregs[5]);
                $("#txMal3").val(pregs[6]);
                $("#nuComp").val(pregs[7]);
				$("#txTem").val(pregs[8]);
            }
        });

	}
	
	$("#btnSubmit").click(function () {
        $.ajax({
            data:  {correo: $("#txCor").val(), enun: $("#txEnu").val(), ok: $("#txOk").val(), mal1: $("#txMal1").val(), mal2: $("#txMal2").val(), mal3: $("#txMal3").val(), nuComp: $("#nuComp").val(), txTem: $("#txTem").val()},
            url:   '../php/mandarPreguntasAjax.php?insert=3',
            type:  'post',
            success:  function (response) {
                alert('Se ha modificado el registro.');
                $(location).attr("href", "RevisarPreguntas.php");
            }
        });	   
	});
	
	visualizar();
});

function pedirDatos(correo, enun, ok, mal1, mal2, mal3, comp, tema){
	console.log(mal2);
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST","../php/mandarPreguntasAjax.php?insert=2", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("correo="+correo+"&enunciado="+enun+"&Ok="+ok+"&mal1="+mal1+"&mal2="+mal2+"&mal3="+mal3+"&iComp="+comp+"&iTema="+tema);
	xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log("1");
            visualizar();
        }
    }
}
