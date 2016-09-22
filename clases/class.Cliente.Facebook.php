<?php

class ClienteFacebook
{
	private $id_cliente = FACEBOOK_API_KEY;
	private $secret_id = FACEBOO_SECRET_KEY;
	private $redirect_uri;
	private $token;

	public function __construct()
	{
		$this->redirect_uri = "http://127.0.0.1:8080/segurity_php/cuentas/usuarios";
	}
}

?>