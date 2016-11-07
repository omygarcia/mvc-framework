<?php

class FormValidate
{
	const required;


	public static function validar($arr)
	{
		$nombre = "";
		$arr2 = [
			$nombre,array("required","min:3","max:25")
		];

		FormValidate::required($arr2[0]);


	}

	public static function required($var)
	{
		$errors = [];
		if(!isset($var))
		{

		}
	}
}


?>