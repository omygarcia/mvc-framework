<?php

class User_Model extends Model
{

	public function registraUsuario($correo,$pw,$nombre,$apellido,$sexo,$fecha_nacimiento)
	{
		$consulta = "INSERT INTO tb_usuario (correo,pw,nombre,apellido,sexo,fecha_nacimiento)
		VALUES ('$correo','$pw','$nombre','$apellido','$sexo','$fecha_nacimiento')";
		if($this->conn->query($consulta))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function restablecerPassword($correo)
	{
		$consulta = "UPDATE tb_usuario SET password='".sha1(Helper::randomText(6))."' WHERE correo='$correo'";
		if($this->conn->query($consulta))
		{
			return true;
		}
		else
		{
			return false;
		}	
	}


	
}

?>