<?php

class Home_controller
{
	public function __construct()
	{
		require_once("clases/class.session.php");
	}

	public function index()
	{
		$session = new Session();
		$logueado = $session->isLoggedIn();
		$titulo = "Home";
		include "vistas/templates/head.php";
		include "vistas/templates/header.php";
		include "vistas/templates/nav.php";
		include "vistas/home/home.php";
		include "vistas/templates/footer.php";
	}

	public function acerca()
	{
		$session = new Session();
		$logueado = $session->isLoggedIn();
		$titulo = "acerca";
		include "vistas/templates/head.php";
		include "vistas/templates/header.php";
		include "vistas/templates/nav.php";
		include "vistas/home/acerca.php";
		include "vistas/templates/footer.php";
	}

	public function contacto()
	{
		$session = new Session();
		$logueado = $session->isLoggedIn();
		$titulo = "contacto";
		include "vistas/templates/head.php";
		include "vistas/templates/header.php";
		include "vistas/templates/nav.php";
		include "vistas/home/contacto.php";
		include "vistas/templates/footer.php";
	}
}

?>