<?php 
class Registro {
	public static function procesar($app){
		
		global $twig;
		
		$guardar=Utilidades::getDatosFormulario($app);
		
		
		if(trim($guardar['password'])=='' || trim($guardar['password_confirmation'])==''){
			$guardar['error']="Debe introducir la contraseña";
			echo $twig->render('registro.php',$guardar);
			return;
		}
		
		if ($guardar['password']==$guardar['password_confirmation']) {
			$almacenar=array(
			       "NOMBRE_COMPLETO" => $guardar["Apellidos"] . ", ". $guardar["Nombre"],
			       "EMAIL"=>$guardar['email'],
			       "CLAVE"=>$guardar['password']
			);
			try
			{
				AccesoDatos::guardar($app->db, "USUARIO", $almacenar);
			}catch(Exception $e){
   				$guardar['error']="Email ya registrado... ¿Desea <a href= '/usuario/recuperar'>recuperar su contraseña</a>?"; 
				echo $twig->render('registro.php',$guardar);
				return;
			}
			
			LoginClave::autenticarEmail($app->db,$guardar['email'], $guardar['password']);
			$app->redirect('/');
	    }
	    else {
			$valores=array();
		    $guardar['error']="¡Las contraseñas no coinciden!";
			echo $twig->render('registro.php',$guardar);
		}		
	}
	
	
}
	
?>
