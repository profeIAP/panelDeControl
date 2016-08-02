<?php

require_once	'controller/Login.php';

class LoginClave extends Login {

	public static function autenticar($pdo, $usuario, $clave){
		
		// TODO comprobar $usuario y $clave contra la BD
		$r=($usuario=="profeIAP" && $clave=="clave");
		
		// Anotamos en sesión el usuario logado (si procede)
		if($r) $_SESSION['user']=strtoupper($usuario);
		
		return $r;
	}
}
?>
