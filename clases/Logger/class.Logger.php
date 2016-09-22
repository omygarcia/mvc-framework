<?php

function logMessage($mensaje)
{
	$dir = BASE_URL;
	$file = $dir."logs/mysitio.log";
	$hfile = fopen($file, "a+");
	if(!is_resource($hfile))
	{
		printf("No se puede abrir el achivo para escribier, checa tus permisos ".$file);
		return false;
	}

	fwrite($hfile,$mensaje);
	fclose($hfile);
	return true;
}

logMessage("Todo Ok");


class Logger
{
	private $hLogFile;
	private $logLevel;

	const DEBUG = 100;
	const INFO = 75;
	const NOTICE = 50;
	const WARNING = 25;
	const ERROR = 10;
	const CRITICAL = 5; 

	private function __construct()
	{
		
	}
}

?>