<?php

class Session 
{
	private $php_session_id;
	private $session_nativa_id;
	private $conn;//objeto de la base de datos
	private $logged_in;
	private $id_usuario;
	private $session_timeout = SESSION_TIMEOUT; //10 minutos y la session se cerrara
	private $session_lifespan = SESSION_LIVESPAN;//1 hora de vida de la sesion
	
	public function __construct()
	{
		//inicializamos la base de datos
		if(!$this->conn = new mysqli(SERVER,USER,PW,DB))
		{
			echo "fallo la conexion";
		}
		
		session_set_save_handler(
				array(&$this, "_session_open_method"),//open 
				array(&$this, "_session_close_method"),//close 
				array(&$this, "_session_read_method"),//read 
				array(&$this, "_session_write_method"),//write 
				array(&$this, "_session_destroy_method"),//destroy 
				array(&$this, "_session_gc_method")//gc
			);

		$userAgent = $_SERVER["HTTP_USER_AGENT"];
		if(isset($_COOKIE["PHPSESSID"]))
		{
			$this->php_session_id = $_COOKIE["PHPSESSID"];
			$consulta = "SELECT id_session FROM tb_session
					WHERE ascii_session_id = '$this->php_session_id'
						AND id_usuario = '$this->miIdUsuario' 
						AND user_agent = '$userAgent' 
						AND (now() - created) < $this->session_lifespan
						OR last_impresion = null";
					/*$cad = "SELECT id_session FROM tb_session
					WHERE ascii_session_id = '$this->php_session_id'
						AND id_usuario = '$this->id_usuario' 
						AND user_agent = '$userAgent' 
						AND (now() - created) < $this->session_lifespan
						OR last_impresion = null";
						echo $cad;*/
						//echo $consulta;
			if($result = $this->conn->query($consulta))
			{
				if($result->num_rows > 0)
				{
					$row = $result->fetch_array();
					echo $row["id_session"];
					echo "tu session continua vigente";
					$this->logged_in = true;
				}
				else
				{
					echo "destruyendo session por que y pasaron 10 minutos";
					//Eliminar de la base de datos -- 
					$consulta = "DELETE FROM tb_session 
					WHERE ascii_session_id='$this->php_session_id' OR (now() - created) > $this->session_lifespan";
					$this->conn->query($consulta);

					$consulta = "DELETE FROM  tb_variables_de_session  
					WHERE id_session  NOT IN(SELECT ascii_session_id FROM tb_session)";
					$this->conn->query($consulta);
					unset($_COOKIE["PHPSESSID"]);
				}
				$result->free();
			}
			else
			{
				echo "fallo la consulta: ".$this->conn->error;
			}
		}

		echo "<br />id_usuario".$this->id_usuario."<br/>";
		//asignamos el tiempo de vida para la session
		session_set_cookie_params($this->session_lifespan);
		//inicializamos la session
		session_start();
		/*$this->conn->close();
		$this->conn = null;*/
	}

	public function Impress()
	{
		if($this->session_nativa_id)
		{
			$consulta = "UPDATE tb_session SET last_impresion=now() WHERE id_usuario=1";
			$this->conn->query($consulta);
			if($this->conn->affected_rows >0)
			{
				echo "impresion";
			}
		}
	}

	//retorna verdadero o falso si el usuario esta logueado
	public function isLoggedIn()
	{
		return $this->logged_in;
	}

	public function login($correo,$pw)
	{
		$consulta = "SELECT id_usuario,nombre FROM tb_usuario WHERE correo='".$correo."' AND pw='".sha1($pw)."'";
		echo $consulta;
		if($result = $this->conn->query($consulta))
		{
			if($result->num_rows > 0)
			{
				$row = $result->fetch_array();
				$this->id_usuario = $row['id_usuario'];
				$this->miIdUsuario = $row['id_usuario'];
				$this->miNombre = $row['nombre'];
				$this->logged_in = true;
				$consulta = "UPDATE tb_session SET logged_in=true,id_usuario='$this->id_usuario' 
				WHERE ascii_session_id='$this->php_session_id'";
				if($this->conn->query($consulta))
				{
					echo "consulta";
					if($this->conn->affected_rows > 0)
					{
						echo "Todo Ok";
					}
					else
					{
						echo $this->conn->error;
					}
				}
				else
				{
					echo $this->conn->error;
				}
				//echo $consulta;
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	public function logout()
	{
		if($this->logged_in == true)
		{
			$consulta = "UPDATE tb_session SET logged_in=false, id_usuario=0 WHERE ascii_session_id='$this->php_session_id'";
			$this->conn->query($consulta);
			$this->logged_in = false;
		}
	}

	public function __set($nvar,$val)
	{
		$sval = serialize($val);
		$consulta = "SELECT * FROM tb_variables_de_session
		WHERE id_session ='$this->php_session_id' AND clave = '$nvar'";
		$result = $this->conn->query($consulta);
		if($result->num_rows > 0)
		{
			$consulta = "UPDATE tb_variables_de_session SET valor='$sval'
			WHERE id_session='$this->php_session_id' AND clave='$nvar'";
			$this->conn->query($consulta);
		}
		else
		{
			$consulta = "INSERT INTO tb_variables_de_session (id_session,clave,valor)
		  	VALUES ('".$this->php_session_id."','".$nvar."','".$sval."')";
			$this->conn->query($consulta);
		}
	}

	public function __get($nm)
	{
		$consulta = "SELECT valor FROM tb_variables_de_session
		WHERE id_session='$this->php_session_id' AND clave='$nm'";
		$result = $this->conn->query($consulta);
		if($result->num_rows > 0)
		{
			$row = $result->fetch_array();
			return unserialize($row['valor']);
		}
		else
		{
			return false;
		}
	}

	private function _session_open_method($save_path,$session_name)
	{
		echo $save_path." ".$session_name;
		return true;
	}

	public function _session_close_method()
	{
		echo "close";
		$this->conn->close();
		$this->conn = null;
		return true;
	}

	public function _session_read_method($id)
	{
		echo "read ($id)\n";
		$strUserAgent = $_SERVER['HTTP_USER_AGENT'];
		$this->php_session_id = $id;
		$failed = 1;
		$result = $this->conn->query("SELECT id_session,logged_in,id_usuario FROM tb_session WHERE ascii_session_id = '$id'");
		if($result->num_rows > 0)
		{
			$row = $result->fetch_array();
			$this->session_nativa_id = $row['id_session'];
			if($row["logged_in"] == true)
			{
				$this->logged_in = true;
				$this->id_usuario = $row["id_usuario"];
			}
			else
			{
				$this->id_usuario = 0;
				$this->logged_in = false;
			}
		}
		else
		{
			$this->id_usuario = 0;
			$this->logged_in = false;
			$consulta = "INSERT INTO tb_session (ascii_session_id,logged_in,id_usuario,created,user_agent)
				VALUES ('$id',false,0,now(),'$strUserAgent')";
			if(!$this->conn->query($consulta))
			{
				echo "fallo insercion: ".$this->conn->error;
			}
			//ahora obtenemos el verdadero id
			$consulta = "SELECT id_session FROM tb_session WHERE ascii_session_id = '$id'";
			$result = $this->conn->query($consulta);
			$row = $result->fetch_array();
			$this->session_nativa_id = $row["id_session"];
		}
		return "";
	}

	public function _session_write_method($id,$ses_data)
	{
		echo "write ($id, $ses_data)\n";
		return true;
	}

	private function _session_destroy_method($id)
	{
		$consulta = "DELETE FROM tb_session WHERE ascii_session_id='$id'";
		$this->conn->query($consulta);
		return true;
	}

	private function _session_gc_method($maxlifetime)
	{
		return true;
	}

}

?>