<?php
require_once("config/config.php");
//autoload
if(isset($autoload) && is_array($autoload))
{
	foreach ($autoload as $key) {
		require_once("clases/class.".$key.".php");
	}
}
require_once("core/class.Model.php");
require_once("helper/class.helper.php");
require_once("clases/Logger/class.Logger.php");
require_once("clases/class.Form.php");

if(!isset($_GET['controller']))
	$controller = "home";
else
	$controller = $_GET['controller'];
//setteamos la accion
if(isset($_GET["action"]))
	$action = $_GET["action"];
else
	$action = "index";
if(file_exists("controller/".$controller."_controller.php"))
{
	require_once("controller/".$controller."_controller.php");
	switch ($controller) {
		case 'home':
			$vista = new Home_controller();
			if($action == "index")
				$vista->index();
			else if($action == "acerca")
				$vista->acerca();
			else if($action == "contacto")
				$vista->contacto();
			break;
		case 'cuentas':
			$vista = new cuentas_controller();
			if($action == "login")
				$vista->login($_POST['txt_correo'],$_POST['txt_pw']);
			else if($action == "usuarios")
				$vista->usuarios();
			else if($action == "logout")
				$vista->logout();
			else if($action == "registro_usuarios")
				$vista->registro_usuarios();
			else if($action == "forgotMyPassword")
				$vista->forgotMyPassword();
			else if ($action == "cargarCaptcha") 
				$vista->cargarCaptcha();
			else if($action == "registrar")
				$vista->registrar();
			else if($action == "reestablecer")
				$vista->reestablecerPassword();
			else if($action == "changeMyPassword")
				$vista->changeMyPassword();
			break;
		case 'redes':
			$vista = new Redes_Controller();
			if($action == "login")
			{
				$vista->login();
			}
			else if($action == "fb-callback")
			{
				$vista->fb_callback();
			}
		default:
			
			break;
	}
	//var_dump(get_class_methods($controller."_controller"));
}

/*echo $_SERVER["REQUEST_METHOD"]; //GET POST PUT DELETE
echo $_SERVER["REQUEST_URI"];*/

/*echo hash("gost-crypto", "123");
$algos = hash_algos();
foreach ($algos as $algo) {
	echo $algo."<br />";
}
*/

//echo uniqid();
/*try
{
$client = new SoapClient("http://webservices.amazon.com/AWSECommerceService/AWSECommerceService.wsdl");
	var_dump($client->__getFunctions());
	$funcs = $client->__getFunctions();


	foreach ($funcs as $key) 
	{
		echo "<b>".$key."</b><span style='background:#fff000';color:white;></span><br>";	
	}
}
catch(Exception $ex)
{
	echo "<b>mensaje:</b>".$ex->getMessage();
}*/
/*else if(!preg_match("/^(d){1,4}-(d){1,2}-(d){1,2}+$/i", $fecha))
		{
			checkdate(month, day, year)
			$mensaje = "el formato de fecha no es correcto, año/mes/dia ..".$fecha;
		}*/
		//echo (preg_match("\^d{4}-d{2}-d{2}/", date('Y-m-d')))?"valido":"no valido";
/*
$_SESSION["data"] = array(	
							array(
									'id' => "155",
									"producto" => "coca",
									"precio" => "19.00",
									"option" => array("tamaño"=>"grande","color"=>"rojo")
									),
							 array(
									'id' => "155",
									"producto" => "coca",
									"precio" => "19.50",
									"option" => array("tamaño"=>"chico","color"=>"azul")
									)
						);
var_dump($_SESSION);

echo $_SESSION["data"][1]["option"]["tamaño"];
echo "<br />";
$i=0;
foreach ($_SESSION['data'] as $key) 
{
	echo $i++." ".$key["id"]." ".$key["producto"]." ".$key["precio"]." ".$key["option"]["tamaño"]." ".$key["option"]["color"]."<br />";
}
echo addslashes("INSERT INTO tb_user (nombre) Values ('pepe')");
echo "<br />".htmlentities($_SERVER['PHP_SELF'])."<br />";
echo "<br />".htmlentities("http://127.0.0.1:8080/security_php/<script>alert('todo Ok');</script>")."<br />";
echo sha1("123")."<br />";
echo hash("sha512", "123")."<br />";
echo $_COOKIE["PHPSESSID"]."<br />";
*/
//chmod("logs/mysitio.log", 0744);
//echo $_SESSION['aleatorio'];
/*
$cadenaConexion="mysql:host=localhost;root;dbname=db_ferreteria";
try
{
	$objPDO = new PDO($cadenaConexion);
	printf("Conexion exitosa!");
}
catch(PDOException $ex)
{
	echo "Ocurrio un error: ".$ex->getMessage();
}
$objPDO = null;
echo serialize("hola")." ".serialize("producto")." ".serialize("pepe");
echo var_dump($_SESSION);*/

/*require_once('clases/api_facebook/src/Facebook/Facebook.php');
require_once('clases/api_facebook/src/Facebook/FacebookApp.php');
require_once('clases/api_facebook/src/Facebook/FacebookClient.php');
require_once('clases/api_facebook/src/Facebook/FacebookRequest.php');*/

//include "clases/Logger/class.Logger.php";
//echo "<br />".date('Y/m/d h:i:s');
?>


<!--<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '<?=FACEBOOK_API_KEY;?>',
      xfbml      : true,
      version    : 'v2.7'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));


  FB.getLoginStatus(function(response) {
  if (response.status === 'connected') {
    console.log('Logged in.');
  }
  else {
    FB.login();
  }
});

</script>-->