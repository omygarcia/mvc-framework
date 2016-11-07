<?php

/*function logMessage($mensaje)
{
	$file = "C:\\xampp7\\htdocs\\security_php\\logs\\mysitio.log";
	//cambiamos los permisos, a escritura
	//chmod("C:\\xampp7\\htdocs\\security_php\\logs\\mysitio.log", 0744);
	//chown("C:\\xampp7\\htdocs\\security_php\\logs\\mysitio.log", "nobody");
	$hfile = fopen($file, "a+");
	if(!is_resource($hfile))
	{
		printf("No se puede abrir el achivo para escribir, checa tus permisos ".$file);
		return false;
	}

	fwrite($hfile,$mensaje);
	fclose($hfile);
	return true;
}

logMessage("Todo Ok \n");
*/
class Config
{
	public static function getConfig()
	{
		$config = array(
			'LOGGER_LEVEL' => '75',
			'LOGGER_FILE' => 'C:\\xampp7\\htdocs\\security_php\\logs\\mysitio.log' 
			);
		return $config;
	}
}

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
		$cfg = Config::getConfig();
		$this->logLevel = ($cfg['LOGGER_LEVEL'])?$cfg['LOGGER_LEVEL']:Logger::INFO;

		$logFilePath = $cfg['LOGGER_FILE'];

		$this->hLogFile = @fopen($logFilePath, 'a+');

		if(!is_resource($this->hLogFile))
		{
			throw new Exception("El archivo $logFilePath no se puede abrir, para escritura, checa los permisos");
		}

		//stream_encoding($this->hLogFile, "iso-8859-1");
	}

	public function __destruct()
	{
		if(is_resource($this->hLogFile))
		{
			fclose($this->hLogFile);
		}
	}

	public static function getInstance()
	{
		static $objLog;

		if(!isset($objLog))
		{
			$objLog = new Logger();
		}

		return $objLog;
	}

	public function logMessage($msg, $logLevel = Logger::INFO, $module = null)
	{
		if($logLevel > $this->logLevel)
		{
			return;
		}

		$time = date('Y/m/d h:i:s');
		$msg = str_replace("\n", " ", $msg);
		$msg = str_replace("\t", " ", $msg);
		$strLogLevel = $this->levelToString($logLevel);

		if(isset($module))
		{
			$module = str_replace("\n", " ", $module);
			$module = str_replace("\t", " ", $module);
		}

		$logLine = "$time\t$strLogLevel\t$msg\t$module\n";
		fwrite($this->hLogFile, $logLine);
	}

	public static function levelToString($logLevel)
	{
		switch ($logLevel) {
			case Logger::DEBUG:
				return 'Logger::DEBUG';
				break;

			case Logger::INFO:
				return 'Logger::INFO';
				break;

			case Logger::NOTICE:
				return 'Logger::NOTICE';
				break;

			case Logger::WARNING:
				return 'Logger::WARNING';
				break;

			case Logger::ERROR:
				return 'Logger::ERROR';
				break;

			case Logger::CRITICAL:
				return 'Logger::CRITICAL';
				break;

			default:
				return "[unknown]";
				break;
		}
	}
}

/*$log = Logger::getInstance();

$_GET['foo'] = "Mi comida";

if(isset($_GET['foo']))
{
	$log->logMessage("La vairable foo esta evaluada",Logger::DEBUG);
	$log->logMessage("El valor de la variable foo es: ".$_GET['foo']);
}
else
{
	$log->logMessage("la variable foo no esta evaluada",Logger::CRITICAL,"foo module");
	throw new Exception("la variable foo no esta evaluada");
}
*/
?>