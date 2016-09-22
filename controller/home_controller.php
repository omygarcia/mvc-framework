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
}

?>