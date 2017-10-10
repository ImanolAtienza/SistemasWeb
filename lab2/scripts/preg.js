$(function(){
	$(document).ready(function () {
		// 
		$("#fpreguntas").submit(function () {
				var expr = /(^[a-z]+)([0-9]{3})\@ikasle\.ehu\.(es|eus)/;
			
				if($("#txCor").val() == "" || !expr.test($("#txCor").val())) 
					return false;

				if($("#txEnu").val().length < 9)
					return false;

				if($("#txOk").val() == "" || $("#txMal1").val() == "" || $("#txMal2").val() == "" || $("#txMal3").val() == "" || $("#txTem").val() == "") 
					return false;

				if($("#nuComp").val() < 1 || $("#nuComp").val() > 5 || $("#nuComp").val() == "")
					return false;

				return true;
		});
	
		//
		$("#imPre").change(function (event) {
			$("#imEjem").attr("src", URL.createObjectURL(event.target.files[0]));
		});
	});
});