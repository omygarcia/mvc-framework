<?php

//configurando url principal
define("BASE_URL", "");

//Configuracion de la base de datos
define("SERVER", "");
define("USER", "");
define("PW", "");
define("DB", "");

//sessiones
define("SESSION_TIMEOUT", 600);//10 minutos y la session se cerrara
define("SESSION_LIVESPAN", 3600);//tiempo de vida de la session 3600 = 1 hora

//APIS

//PAYPAL
define("PAYPAL_API_KEY", "");
define("PAYPAL_SECRET_KEY", "");
define("MODE_PAYPAL", ""); // sandbox ó live

//Facebook
define("FACEBOOK_API_KEY", "");
define("FACEBOOK_SECRET_KEY", "");

//Twitter
define("TWITTER_API_KEY", "");
define("TWITTER_SECRET_KEY", "");

//WeatherBug
define("WEATHERBUG_API_KEY", "");
define("WEATHERBUG_SECRET_KEY", "");

//configuracion correo electronico
define("E-MAIL", "");
define("E-MAIL-PW", "");

//configuracion zona horaria
date_default_timezone_set('America/Mexico_City');

$autoload = array("DataManager");

?>
