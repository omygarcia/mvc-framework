<?php

class Cuentas_controller
{
	private $session;
	private $usuario;

	public function __construct()
	{
		require_once("clases/class.session.php");
		$this->session = new Session();
		require_once("modelos/user.php");
		$this->usuario = new User_Model();
	}

	public function login($email = "",$pw = "")
	{
		//$this->session->login($email,$pw);
		if($this->session->intentos >= 5)
		{
			$log = Logger::getInstance();
			$msgLog = "Intentos de inicio de session: ".$this->session->intentos." Agente: ".$_SERVER['HTTP_USER_AGENT']." Correo: ".$email."";
			$log->logMessage($msgLog,Logger::CRITICAL,"Modulo: Login");

			if(!$_POST['txt_captcha'] == $this->session->aleatorio)
			{
				header("location:".BASE_URL);
				exit();
			}	
		}

		$email = strip_tags(addslashes($email));
		if($this->session->login($email,$pw))
		{
			$this->session->intentos = 0;
			header("location:".BASE_URL."cuentas/usuarios");
		}
		else
		{
			$this->session->intentos = ($this->session->intentos + 1);
			header("location:".BASE_URL);
		}
	}

	public function logout()
	{	
		$this->session->logout();
		header("location:".BASE_URL);
	}

	public function usuarios()
	{
		$session = $this->session;
		if($session->isLoggedIn()==true)
		{
			//echo "Bienvenido";
		}
		else
			header("location:".BASE_URL);
		$session->impress();
		$titulo = "Usuarios";
		include "vistas/templates/head.php";
		include "vistas/templates/header.php";
		include "vistas/templates/nav.php";
		include "vistas/cuentas/usuarios.php";
		include "vistas/templates/footer.php";
	}

	public function registro_usuarios()
	{
		$session = $this->session;
		$logueado = $session->isLoggedIn();
		$titulo = "Registro Usuarios";
		include "vistas/templates/head.php";
		include "vistas/templates/header.php";
		include "vistas/templates/nav.php";
		include "vistas/cuentas/registro_usuarios.php";
		include "vistas/templates/footer.php";	
	}

	public function registrar()
	{
		$mensaje = "";
		$nombre = strip_tags($_POST['txt_nombre']);
		$apellido = strip_tags($_POST['txt_apellido']);
		$sexo = strip_tags($_POST['slp_sexo']);
		$correo = strip_tags($_POST['txt_correo']);
		$pw = strip_tags($_POST['txt_pw']);
		$fecha = strip_tags($_POST['txt_fecha_nac']);
		$captcha = strip_tags($_POST['txt_captcha']);
		//echo var_dump($_POST);
		if(!isset($nombre) || empty($nombre))
		{
			$mensaje = "El campo nombre es obligatorio";
		}
		else if(!isset($apellido) || empty($apellido))
		{
			$mensaje = "El campo apellido es obligatorio";
		}
		else if (!isset($sexo) || empty($sexo) || $sexo == '0' || $sexo != "h" && $sexo != 'm') 
		{
			$mensaje = "Seleccion una opción";
		}
		else if(!isset($correo) || empty($correo))
		{
			$mensaje = "El campo correo es obligatorio";
		}
		else if(!preg_match('/^([A-Z0-9._%-]+)(\@)([A-Z0-9._%-]+)(\.)([A-Z0-9._%-]{2,4})$/i', $correo))
		{
			$mensaje = "<span class='error'>correo electronico no valido</span>";
		}
		else if(!isset($pw) || $pw == "")
		{
			$mensaje = "El campo password es obligatorio";
		}
		else if(!isset($fecha) || $fecha == "")
		{
			$mensaje = "el campo fecha es obligatorio";
		}
		else if($captcha == "")
		{
			$mensaje = "El campo captcha es obligatorio";
		}
		else if($captcha != $this->session->aleatorio)
		{
			$mensaje = "El captcha no es correcto";
		}
		else
		{	
			if(!$this->usuario->verificarCorreo($correo))
			{
				$datos = array(
						"nombre" => $nombre,
						"apellido" => $apellido,
						"sexo" => $sexo,
						"correo" => $correo,
						"pw" => sha1($pw),
						"fecha_nac" => $fecha
					);

				if($this->usuario->registraUsuario($datos))
				{
					$mensaje = "Usuario registrado correctamente";
				}
				else
				{
					$mensaje = "No se pudo registrar el usuario";
				}
			}
			else
			{
				$mensaje = "El correo ".$_POST['txt_correo']." ya esta registrado";
			}
		}

		echo $mensaje;
	}

	public function forgotMyPassword()
	{
		$session = $this->session;
		$logueado = $session->isLoggedIn();
		$titulo = "Restablecer Password";
		include "vistas/templates/head.php";
		include "vistas/templates/header.php";
		include "vistas/templates/nav.php";
		include "vistas/cuentas/forgotMyPassword.php";
		include "vistas/templates/footer.php";
	}

	public function reestablecerPassword()
	{
		$session = $this->session;
		$correo = (isset($_POST['txt_correo']))?strip_tags($_POST['txt_correo']):"";
		$captcha = (isset($_POST['txt_captcha']))?strip_tags($_POST['txt_captcha']):"";
		$mensaje = "";
		$tipo = "error";

		if(!isset($correo) || $correo == "")
		{
			$mensaje = "El campo correo es obligatorio";
		}
		if(!preg_match('/^([A-Z0-9._%-]+)(\@)([A-Z0-9._%-]+)(\.)([A-Z0-9._%-]{2,4})$/i',$correo))
		{
			$mensaje = "El correo electronico no es valido";
		}
		else if($captcha == "")
		{
			$mensaje = "El campo captcha es obligatorio";
		}
		else if($captcha != $session->aleatorio)
		{
			$mensaje = "El captcha no es correcto";
		}
		else if(!$this->usuario->verificarCorreo($correo))
		{
			$mensaje = "El correo no esta registrado";
		}
		else
		{
			$new_pw = Helper::randomText(6);
			if(!$this->usuario->reestablecerPassword($correo,sha1($new_pw)))
			{
				echo $mensaje;
				//echo json_encode(array("mensaje"=>"No se Pudo registrar","tipo"=>"error"));
				exit;
			}
			require_once("clases/Comunicacion/phpmailer/class.phpmailer.php");
			require_once("clases/Comunicacion/phpmailer/class.smtp.php");

			$de = EMAIL;
			$para = $correo;
			$asunto = "Tu confirmacion";

			$mensajeMail = "Tu password se a reestablecido. Esta es tu nuevo password <b>$new_pw</b>, puedes cambiarlo en el menu";

			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = "ssl";
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 465;
			$mail->Username = EMAIL;
			$mail->Password = EMAIL_PW;

			$mail->SetFrom($de,"Sitio.com");
			$mail->AddReplyTo($de,"Sitio.com");
			$mail->AddAddress($para,"");
			
			$mail->Subject = $asunto;
			$mail->MsgHTML($mensajeMail);

			if($mail->send())
			{
				$tipo = "Ok";
				$mensaje = "mensaje enviado";
			}
			else
			{
				$mensaje = "mensaje no se envio. Error:".$mail->ErrorInfo;
			}
			
		}
		/*$mensajeArr = array();
		$mensajeArr["mensaje"]=$mensaje;
		$mensajeArr["tipo"]=$tipo;
		echo json_encode($mensajeArr);*/
		echo $mensaje;
	}

	public function changeMyPassword()
	{
		if($this->session->isLoggedIn()==false)
			header("location:".BASE_URL);
		$id_usuario = $this->session->miIdUsuario;
		$pw = sha1($_POST['txt_pw']);
		$new_pw = sha1($_POST['txt_new_pw']);
		if(!isset($pw) || $pw == "")
		{
			echo "El campo password es obligatorio";
		}
		else if(!isset($new_pw) || $new_pw == "")
		{
			echo "El campo nuevo password es obligatorio";
		}
		else if($this->usuario->verificarPassword($id_usuario,$pw))
		{
			if($this->usuario->cambiarMiPassword($id_usuario,$new_pw))
			{
				echo "tu password se actualizo con exito!";	
			}
			else
			{
				echo "No se pudo actualizar el password";
			}
			
		}
		else
		{
			echo "Verifica tu password";
		}
	}

	public function cargarCaptcha()
	{
		$session = $this->session;
		$session->aleatorio = Helper::randomText(6);
		Helper::getCaptcha($session->aleatorio);
	}

}

?>