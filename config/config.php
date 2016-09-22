<?php

//configurando url principal
define("BASE_URL", "http://127.0.0.1:8080/security_php/");

//Configuracion de la base de datos
define("SERVER", "127.0.0.1");
define("USER", "root");
define("PW", "");
define("DB", "pruebas_php6");

//sessiones
define("SESSION_TIMEOUT", 600);//10 minutos y la session se cerrara
define("SESSION_LIVESPAN", 3600);//tiempo de vida de la session 3600 = 1 hora

//APIS

//PAYPAL
define("PAYPAL_API_KEY", "");
define("PAYPAL_SECRET_KEY", "");
define("MODE_PAYPAL", ""); // sandbox ó live

//Facebook
define("FACEBOOK_API_KEY", "404790399648658");
define("FACEBOOK_SECRET_KEY", "851cca60826761e81690939207d3492a");

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