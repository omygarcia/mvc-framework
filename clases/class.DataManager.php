<?php

class DataManager
{
	public static function getConexion()
	{
		return new mysqli(SERVER,USER,PW,DB);
	}
}

?>