<?php

class Form
{
	public static function open($arr = array())
	{
		$form = "";
		if(empty($arr))
		{
			$arr= [
				"action" => "",
				"method" =>""
			];
		}

		if(!isset($arr["method"]) || $arr["method"] == "")
		{
			$arr["method"] == "GET";
		}

		if(!isset($arr["action"]))
		{
			$arr["action"] == "";
		}
		
		if(isset($arr["enctype"]))
		{
			$enctype = "enctype='multipart/form-data'";
		}
		else
		{
			$enctype='';
		}
		//verificamos el typo de metodo de envio de datos
		if($arr["method"] == "PUT" || $arr["method"] == "DELETE")
		{
			/*en el caso que sea PUT ó DELETE el emtodo por defecto es POST
				pero se creara un campo oculto para indicar que el tipo de metodo
			*/
			$form = "<form action='".$arr["action"]."' method='POST' $enctype >";
			if($arr["method"] == "PUT")
			{
				$form.="<input type='hidden' name='_method' value='PUT' />";
			}
			else if($arr["method"] == "DELETE")
			{
				$form.="<input type='hidden' name='_method' value='DELETE' />";
			}
		}
		else
		{
			$form = "<form action='".$arr["action"]."' method='".$arr["method"]."' $enctype >";
		}

		return $form;
	}

	public static function close()
	{
		$form = "</form>";
		return $form;
	}

	//genera un input para protección contra solicitudes falsas
	public static function csrf_field()
	{
		//$session->csrf = Helper::randomText(32);
		return "<input type='hidden' name='txt_csrf' value='".Helper::randomText(32)."' />";
	}

	public static function validar()
	{
		if($_POST["txt_csrf"] =! $session->csrf)
		{
			header("Location:".BASE_URL);
			exit();
		}

		$arr = [
			"correo" => ["omycorreo.com","required","isEmail"]
		];

		eval($arr["nombre"][1]."();");
	}

	public static function required($campo)
	{
		if(!isset($campo) && empty($campo))
		{
			return "El campo es requerido";
		}
		return;
	}

	public static function isEmail($correo)
	{
		if(!preg_match('/^([A-Z0-9._%-]+)(\@)([A-Z0-9._%-]+)(\.)([A-Z0-9._%-]{2,4})$/i', $correo))
		{
			return "El correo no es valido";
		}

		return;
	}
}

?>