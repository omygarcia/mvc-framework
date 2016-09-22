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

if(!isset($_GET['controller']))
	$controller = "home";
else
	$controller = $_GET['controller'];
//setteamos la accion
if(isset($_GET["action"]))
	$action = $_GET["action"];
if(file_exists("controller/".$controller."_controller.php"))
{
	require_once("controller/".$controller."_controller.php");
	switch ($controller) {
		case 'home':
			$vista = new Home_controller();
			$vista->index();
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
			break;
		default:
			
			break;
	}
	//var_dump(get_class_methods($controller."_controller"));
}
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
/*
require_once(__FILE__.'clases/api_facebook/src/Facebook');

$data = array(
		"id" => "",
		"secret" => ""
	);

$uri = "";

try
{
	$facebook = new Facebook($data);
	$url = $facebook->getLoginUrl(array("redirect_uri" => "http://127.0.0.1:8080/segurity_php/cuentas/usuarios"));
}
catch(Exception $ex)
{
	echo $ex->getMessage();
}
?>
<a href="<?=$url;?>">Login con facebook</a>*/
//include "clases/Logger/class.Logger.php";
?>