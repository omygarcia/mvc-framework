;
$(window).on("ready",main);

function main()
{
	/*$("#btn_ingresar").click(function(){
		//event.preventDefault();
		var correo = $("input[name=txt_correo]").val();
		var pw = $("input[name=txt_pw]").val();
		var mensaje = "";

		if(correo == "")
		{
			mensaje = "<div class='error'>El campo correo es obligatorio</div>";
		}
		else if(pw == "")
		{
			mensaje = "<div class='error'>El campo password es obligatorio</div>";
		}

		$("#mensaje").html(mensaje);
	});*/
	$("#menu_ingresar").click(function(e){
		//alert("todo ok");
		e.stopPropagation();
		$("#sub_menu_ingresar").toggle();

	});

	$("#sub_menu_ingresar").click(function(e){
		e.stopPropagation();
	});

	$("body").click(function(){
		$("#sub_menu_ingresar").hide();
	});

}

function restablecer()
{
	event.preventDefault();
	var correo = $("input[name=txt_correo]").val();
	var captcha = $("input[name=txt_captcha]").val();
	var datos = {"txt_correo":correo,"txt_captcha":captcha};
	$.ajax({
		url:"http://127.0.0.1:8080/security_php/cuentas/reestablecer",
		data:datos,
		type:"post",
		//dataType:"json",
		beforeSend:
			function()
			{
				$("#loader").show();
			},
		complete:
			function()
			{
				$("#loader").hide();
				//$("#captcha").src="http://127.0.0.1:8080/security_php/cuentas/cargarCaptcha";
			},
		success:
			function(response)
			{
				console.log(response);
				//$("#respuesta").html("<div class='error'>"+response+"</div>");
				$("#respuesta").html("<div class='"+response.tipo+"'>"+response.mensaje+"</div>");
			},
		error:
			function(response)
			{
				//$("#respuesta").html("<div class='error'>error en ajax: "+response+"</div>");
				$("#respuesta").html("<div class='error'>error en ajax: "+response.error+"</div>");
			}
	});

}