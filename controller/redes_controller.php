<?php

class Redes_Controller
{
	private $facebook;
	private $session;

	public function __construct()
	{
		require_once("clases/class.Session.php");
		$this->session = new Session();

		require_once('clases/api_facebook/src/Facebook/autoload.php');

		$data = array(
			"app_id" => FACEBOOK_API_KEY,
			"app_secret" => FACEBOOK_SECRET_KEY,
			"default_graph_version" => "v2.2",
		);

		$this->facebook = new Facebook\Facebook($data);
	}

	public function login()
	{
		$permission = array("email","user_likes");
		$uri = "";
		try
		{
			$helper = $this->facebook->getRedirectLoginHelper();
			$url = $helper->getLoginUrl("http://localhost:8080/security_php/redes/fb-callback",$permission);
		}
		catch(Facebook\Exceptions\FacebookSDKException $ex)
		{
			echo "<div class ='error'>".$ex->getMessage()."</div>";
		}
		echo '<a class="btn-facebook" href="'.htmlspecialchars($url).'">Login con facebook</a>';
	}

	public function fb_callback()
	{
		try
		{
			$helper = $this->facebook->getRedirectLoginHelper();
			$accessToken = $helper->getAccessToken();
			if(isset($accessToken))
			{
				$this->session->token = $accessToken;
				echo "Loggeado: ".$accessToken;
				//header("Location:".BASE_URL);
			}
			else
			{
				if($helper->getError())
				{
					echo "Error: ".$helper->getError()."<br />";
					echo "Codigo:".$helper->getErrorCode()."<br />";
					echo "Razon:".$helper->getErrorReason()."<br />";
					echo "Descripci&oacute;n:".$helper->getErrorDescription()."<br />";
				}
				else
				{
					header('HTTP/1.0 400 Bad Request');
					echo "back request";
				}
				echo "No Loggeado";
			}
		}
		catch(Facebook\Exceptions\FacebookResponseException $ex)
		{
			echo "<div class ='error'>".$ex->getMessage()."</div>";
		}
		catch(Facebook\Exceptions\FacebookSDKException $ex)
		{
			echo "<div class ='error'>".$ex->getMessage()."</div>";			
		}
	}

}


?>