<?php

require_once	'controller/Login.php';

class LoginClave extends Login {

	public static function autenticar($usuario, $clave){
		return ($usuario=="profeIAP" && $clave=="clave");
	}
}
?>
