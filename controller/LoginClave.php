<?php

require_once	'controller/Login.php';

class LoginClave extends Login {

	public static function autenticar($pdo, $usuario, $clave){
		return ($usuario=="profeIAP" && $clave=="clave");
	}
}
?>
