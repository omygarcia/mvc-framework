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
		if($this->session->login($email,$pw))
		{
			header("location:".BASE_URL."index.php/cuentas/usuarios");
		}
		else
		{
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
			echo "Bienvenido";
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
		if(!preg_match('/^([A-Z0-9._%-]+)(\@)([A-Z0-9._%-]+)(\.)([A-Z0-9._%-]{2,4})$/i', $_POST['correo']))
		{
			$mensaje = "correo electronico no valido";
		}
		else if(!isset($_POST['pw']))
		{
			$mensaje = "El campo password es obligatorio";
		}
		else
		{	
			$this->usuario->registraUsuario();
			$mensaje = "Usuario registrado correctamente";
		}

		return $mensaje;
	}

	public function forgotMyPassword()
	{
		$session = $this->session;
		$titulo = "Restablecer Password";
		include "vistas/templates/head.php";
		include "vistas/templates/header.php";
		include "vistas/templates/nav.php";
		include "vistas/cuentas/forgotMyPassword.php";
		include "vistas/templates/footer.php";
	}

	public function reestablecerPassword()
	{
		require_once("clases/Comunicacion/phpmailer/class.phpmailer.php");
		require_once("clases/Comunicacion/phpmailer/class.smtp.php");

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 465;
		$mail->From = $de;
		$mail->AddAddress($para);
		$mail->Username = "correo";
		$mail->password = "";
		$mail->Subject = $asunto;
		$mail->Body = $mensaje;
		$mail->wordwrap = 50;
		$mail->MsgHTML($mensaje);
		$mail->AddAttachment($destino);

		if($mail->send())
		{
			$respuesta = "mensaje enviado";
		}
		else
		{
			$respuesta = "mensaje no se envio";
		}

		echo $respuesta;
	}

	public function changeMyPassword()
	{

	}

	public function cargarCaptcha()
	{
		/*$session = $this->session;
		$session->aleatorio = Helper::randomText(6);*/
		return Helper::getCaptcha("14d4s");
	}

}

?>