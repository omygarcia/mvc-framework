<?php

class User_Model extends Model
{

	public function verificarCorreo($correo)
	{
		$consulta = "SELECT correo FROM tb_usuario WHERE correo='$correo'";
		$result = $this->conn->query($consulta);
		if($result->num_rows > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function registraUsuario($data)
	{
		$consulta = "INSERT INTO tb_usuario (correo,pw,nombre,apellido,sexo,fecha_nacimiento)
		VALUES ('".$data['correo']."','".$data['pw']."','".$data['nombre']."','".$data['apellido']."','".$data['sexo']."','".$data['fecha_nac']."')";
		if($this->conn->query($consulta))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function reestablecerPassword($correo,$new_pw)
	{
		$consulta = "UPDATE tb_usuario SET pw='$new_pw' WHERE correo='$correo'";
		if($this->conn->query($consulta))
		{
			return true;
		}
		else
		{
			return false;
		}	
	}

	public function verificarPassword($id_usuario,$pw)
	{
		$consulta = "SELECT pw FROM tb_usuario WHERE id_usuario='$id_usuario'";
		$result = $this->conn->query($consulta);
		if($result->num_rows > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function cambiarMiPassword($id_usuario,$new_pw)
	{
		$consulta = "UPDATE tb_usuario SET pw='$new_pw' WHERE id_usuario='$id_usuario'";
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