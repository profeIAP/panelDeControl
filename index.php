
<?php 
// ------------------------------------------------------------------------------------------------
//
// SLIM
//
// [http://goo.gl/7KR4vx] Documentación oficial 
// [http://goo.gl/E2hriJ] Uso avanzado de Slim 
// [http://goo.gl/KMglou] Añadir Middleware a determinada ruta (o cómo comprobar está logado)
// [http://goo.gl/n2Q2Zk] Métodos (get, post, delete, ...) válidos en el enrutamiento
// [http://goo.gl/DYkgGd] Cómo mostrar flash() y error() en la Vista
// [http://goo.gl/UzoaCi] Slim MVC framework
//
// VISTA
//
// [http://goo.gl/hU1AVD] BootStrap
// [http://goo.gl/ikw3Cv] Herencia en las Vistas con Twing
//
// VARIOS
//
// [http://goo.gl/wxnSy]  PDO
// [http://goo.gl/pAsYSf] swiftmailer/swiftmailer con composer y "composer update"
// [http://goo.gl/Ld7VXw] Servidor NGINX
//
// GESTION DE USUARIOS
//
// [http://goo.gl/8GIxET] Gestión de sesión de usuario con Slim
// [http://goo.gl/sSJYcd] Control clásico de sesión de usuario en PHP
// [http://goo.gl/meF6p8] Autenticación y XSS con SlimExtra
// [http://goo.gl/PylJvT] Basic HTTP Authentication
// [http://goo.gl/ZZSBk8] PROBLEMA con usuario/clave sin SSL
// [http://goo.gl/9Wa71B] Librería uLogin para autenticación PHP
// [http://goo.gl/sShWmQ] Proteger API con oAuth2.0 (incluye ejemplo)
// [http://goo.gl/uhVAf]  Estudio sobre cómo proteger API sin oAuth
// [http://goo.gl/53iEcN] oAuth con Slim
// [http://goo.gl/PXt2YG] Otra implementación de oAuth
// ------------------------------------------------------------------------------------------------

// DUDA funcionará flash() y error() tras poner session_start() antes de header()

require 	 	'vendor/autoload.php';

require_once	'controller/Utils.php';
require_once	'controller/Email.php';
require_once	'controller/GoogleDrive.php';
require_once	'controller/LoginClave.php';
require_once	'controller/Logger.php';
require_once	'controller/Listado.php';
require_once	'controller/AccesoDatos.php';
require_once	'controller/PermisosACL.php';
require_once	'controller/Parte.php';

session_cache_limiter(false);	
session_start();

date_default_timezone_set('Europe/Madrid');
header('Content-type: text/html; charset=utf-8');

use Respect\Validation\Validator as v;

Twig_Autoloader::register();  

$app = new \Slim\Slim(
		array(
			//'debug' => true,
			'templates.path' => './view'
		)
	);
	
$loader = new Twig_Loader_Filesystem('./view');  

$twig = new Twig_Environment($loader, array(  
	//'cache' => 'cache',  
));  

$app->container->singleton('db', function () {
    return new \PDO('sqlite:model/dictados.db');
});
$app->container->singleton('acl', function () {
	$app = \Slim\Slim::getInstance();
    return new PermisosACL($app->db);
});

$twig->addGlobal('login', new LoginClave()); // Para poder consultar si existe sesión de usuario abierta
$twig->addGlobal('acl', $app->acl); // Para poder consultar si existe sesión de usuario abierta
$twig->addGlobal('utils', new Utilidades()); // Para poder encriptar urls (entre otras funcionalidades)

$app->hook('slim.before.router', function () use ($app) {
	
	global $twig;
	
	$hash=$app->request()->get('hash');
	
	$uri=Utilidades::getCurrentURI();
	$urls_exentas=array(
		"/auth/aceptar",
		"/auth/aceptar?error=access_denied"
	);
	
	// Si hay parámetros en la URL deben proporcionarnos un 'hash'
	
	if(!isset($hash) && count($_GET)>0 && !in_array($uri, $urls_exentas))
	{
		$valores['uri']=Utilidades::getCurrentURI(true);
		echo $twig->render('malandrin-hash.php',$valores);
		$app->stop();
	}
	
	// Si hay 'hash' comprobamos que sea válido
	
	if(isset($hash) && !Utilidades::validarURL($app->request()))
	{
		// IDEA mostrar aviso indicando que no debería estar toqueteando urls
		// IDEA anotar el intento en los logs y/o notificar al administrador de intentos de "sabotaje"
		
		echo $twig->render('malandrin.php');
		$app->stop();
	}
});

$app->get('/','Login::forzarLogin', function() use ($app){
    global $twig;
    echo $twig->render('inicio.php');  
}); 

$app->get('/hash','Login::forzarLogin',function() use ($app){
    global $twig;
    $userPassword="informatica";
    $hash = password_hash($userPassword, PASSWORD_DEFAULT, ['cost' => 12]) ;

	//echo $hash;

	/*
	if (password_verify($userPassword, $hash)) {
		// Login successful.
		 if (password_needs_rehash($hash, PASSWORD_DEFAULT, ['cost' => 12])) {
			// Recalculate a new password_hash() and overwrite the one we stored previously
		}
	}*/
		$userPassword="InFoRmAtIcA";
		$hash2 = password_hash($userPassword, PASSWORD_DEFAULT, ['cost' => 12]);
		
		echo $hash."<br>";
		echo $hash2."<br>";
		$userPasswordveryfied="InFoRmAtIcA";
		
	if (password_verify('InFoRmAtIcA', $hash)) {
		echo '¡La contraseña es válida!';
	} else {
		echo 'La contraseña no es válida.';
	}

});  

$app->group('/auth','Login::forzarLogin', function () use ($app) {
	$app->get('/aceptar', function () use ($app){
		global $twig;
		
		$campos=Utilidades::getDatosFormulario($app);
		
		if(! array_key_exists('error',$campos) && ! is_null(Google::getClient($campos['code'])))
			echo $twig->render('auth_ok.php');
		else
			echo $twig->render('auth_nok.php');
	});

	$app->get('/cancelar', function () use ($app){
		global $twig;
		echo $twig->render('auth_nok.php');
	});
});


$app->group('/alumnos','Login::forzarLogin', function () use ($app) {
	
	$app->group('/anotaciones', function () use ($app) {
		$app->get('/', function() use ($app){
			global $twig;
			// Espacio "dedicado" a juan carlos
		}); 
		
		$app->get('/crear', function() use ($app){
			global $twig;
			
			$valores= array ( "fecha" => date('d/m/Y'));
			
			echo $twig->render('anotacion.php',$valores); 
		});
		
		$app->get('/cancelar', function() use ($app){
			global $twig;
			$app->redirect('/'); 
		});
		
		$app->post('/guardar', function() use ($app){
	
			global $twig;
			
			$valores=Utilidades::getDatosFormulario($app,false, true);
			AccesoDatos::guardar($app->db, "anotacion",$valores);

			// TODO quitar cuando tengamos la lista de anotaciones
			$app->redirect('/alumnos');
		}); 
	});

	$app->group('/importar', function () use ($app) {

		$app->post('/', function() use ($app){
			global $twig;
			$fichero=upload_file();
			// IDEA Permitir importar el fichero CSV de Séneca sin tener que editarlo
			// Para ello debemos comprobar que el número de columnas de la fila a importar coincide con la última y/o penúltima (las primeras tienene menos)
			$valores=import_csv_to_sqlite($app->db, $fichero, array("delimiter"=>",", "table"=>"alumnos_seneca"));
			echo $twig->render('importar.php',$valores);
			unlink($fichero);
			  
		}); 
		
		$app->get('/', function() use ($app){
			global $twig;
			echo $twig->render('upload.php');
		}); 
	
	});
	
     $app->get('/pdf', function() use ($app){
		global $twig;
			
		$r=AccesoDatos::listar($app->db, "alumno", "id, nombre, email, direccion, telefono, comentario, localidad, provincia, dni_tutor, curso");
		$valores=array('alumnos'=>$r);
		
		Listados::generarPDF($twig->render('listado_alumnos.php',$valores),'alumnos');
	 });
	 
     $app->get('/', function() use ($app){
		global $twig;
		
		$r=AccesoDatos::listar($app->db, "t_rol", "*");
		$valores=array('roles'=>$r);
		
		echo $twig->render('usuario.php',$valores);  
	}); 
	
	// [http://goo.gl/52g6F]  Documentación Autocomplete de jQuery UI 
	// [http://goo.gl/Mp7LSN] Ejemplo de uso
	
	// DUDA son métodos utilizados en el formulario del parte
	
	$app->group('/buscar', function () use ($app) {
		$app->get('/nombre', function() use ($app){
			global $twig;
			
			$pdo=$app->db;
			
			$nombre=$app->request()->get('term');
			
			$statement=$pdo->prepare("SELECT nombre || ' (' || curso || ')' value, id FROM alumno where nombre like '%$nombre%'");
			$statement->execute();
			
			echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
		});
		
		$app->post('/id', function() use ($app){
			global $twig;
			
			$id=$app->request()->post('valor');
			
			$miArray=AccesoDatos::recuperar($app->db, "partedatosalumno",$id);
			
			// TODO cargar la asignatura más probable (la más usada por ese profesor para el grupo del alumno)
			
            echo json_encode($miArray);
			
		}); 
	});
	
	$app->get('/borrar', function() use ($app){
		global $twig;
		AccesoDatos::borrar($app->db,"alumno", $app->request()->get('id'));
		$app->redirect('/alumnos');
	}); 
	
	$app->get('/editar', function() use ($app){
		global $twig;
		
		$r=AccesoDatos::recuperar($app->db, 'alumno', $app->request()->get('id'));
		$valores=array('comentario'=>$r);

		echo $twig->render('/alumno.php',$valores);  	
	}); 
	
	$app->post('/guardar', function() use ($app){
	
		global $twig;
		
		// Recogemos datos formulario de contacto
		
		$valores=array(
			'ID'=>$app->request()->post('id'),
			'NOMBRE'=>$app->request()->post('nombre'),
			'EMAIL'=>$app->request()->post('email'),		
			'DIRECCION'=>$app->request()->post('direccion'),	
			'TELEFONO'=>$app->request()->post('telefono'),	
			'COMENTARIO'=>$app->request()->post('comentario'),
			'LOCALIDAD'=>$app->request()->post('localidad'),		
			'PROVINCIA'=>$app->request()->post('provincia'),	
			'DNI_TUTOR'=>$app->request()->post('dni_tutor'),	
			'CURSO'=>$app->request()->post('curso')
		);
		
		AccesoDatos::guardar($app->db, "alumno",$valores);
		$app->redirect('/alumnos');
	}); 

	$app->get('/crear', function() use ($app){
		global $twig;
		echo $twig->render('alumno.php');  
	}); 

}); 

$app->get('/autocompletado','Login::forzarLogin', function() use ($app){
	global $twig;
	echo $twig->render('autocomplete.php');  
}); 

$app->group('/notificaciones','Login::forzarLogin', function () use ($app) {
	
	$app->get('/', 'Utilidades::registrarAccion', function() use ($app){
		global $twig;
		
		$pdo=$app->db;
		$r = $pdo->query("select * from notificacion")->fetchAll(PDO::FETCH_ASSOC);
			
		$valores=array('notificaciones'=>$r);
		echo $twig->render('notificaciones.php',$valores);  
		
	}); 
	
	// DUDA dará problemas el 'Login::forzarLogin' cuando se use Chromecast
	
	$app->get('/rss', function() use ($app){
		global $twig;
     
		 $pdo=$app->db;
		 #$app->response->headers->set('Content-Type', 'text/xml');
		 
		 $r = $pdo->query("select * from notificacion")->fetchAll(PDO::FETCH_ASSOC);
			
		echo $twig->render('rss.php', array('items' => $r));
	});

});

$app->group('/partes','Login::forzarLogin', function () use ($app) {
	
	$app->group('/buscar', function () use ($app) {
	
		$app->get('/poralumno', function() use ($app){
				global $twig;
				
				$valores=array(
					"id_alumno"=>$app->request()->get('id')
				);
				
				$pdo=$app->db;
				$q = $pdo->prepare("select * from partes where id_alumno=:id_alumno");
				$q->execute($valores);
				$r=$q->fetchAll(PDO::FETCH_ASSOC);
			
				
				$valores=array('comentarios'=>$r);
				echo $twig->render('partes.php',$valores);  
				 
			});
			
		});
		
	$app->get('/', function() use ($app){
		
		global $twig;
		
		$pdo=$app->db;
		$r = $pdo->query("select ID, ID_ALUMNO, GRUPO, FECHA, HORA, ASIGNATURA, PROFESOR from partes")->fetchAll(PDO::FETCH_ASSOC);
			
		$valores=array('comentarios'=>$r);
		echo $twig->render('partes.php',$valores);  
	}); 
	
	$app->get('/cancelar', function() use ($app){
		global $twig;
		$app->redirect('/partes');
	}); 
	
	$app->post('/guardar', function() use ($app){
	
		global $twig;
		
		$valores=Utilidades::getDatosFormulario($app);
		AccesoDatos::guardar($app->db,"partes",$valores);
		$app->redirect('/partes');
		
	});
	
	$app->get('/borrar', function() use ($app){
	
		global $twig;
		
		$valores=array(
			"id"=>$app->request()->get('id')
		);
		
		$sql = "delete from partes WHERE ID=:id";
		$pdo = $app->db;
		$q   = $pdo->prepare($sql);
		$q->execute($valores);
		$app->redirect('/partes');
	}); 
	
	$app->get('/crear', function() use ($app){
		global $twig;
		
		$valores= array ( "fecha" => date('d/m/Y'));
		
		echo $twig->render('parte.php', $valores); 
	});
});

$app->group('/usuarios','Login::forzarLogin', function () use ($app) {
	
    $app->get('/', function() use ($app){
		global $twig;
		
		$pdo=$app->db;
		$r = $pdo->query("select id, nombre, email, rol from usuario")->fetchAll(PDO::FETCH_ASSOC);
			
		$valores=array('usuarios'=>$r);
		echo $twig->render('usuarios.php',$valores);  
	}); 
	
	$app->get('/borrar', function() use ($app){
	
		global $twig;
		
		$valores=array(
			"id"=>$app->request()->get('id')
		);
		
		$sql = "delete from usuario WHERE ID=:id";
		$pdo = $app->db;
		$q   = $pdo->prepare($sql);
		$q->execute($valores);
		$app->redirect('/usuarios');
	}); 
	
	$app->get('/editar', function() use ($app){
	
		global $twig;
		
		$valores=array(
			"id"=>$app->request()->get('id')
		);
		
		$pdo=$app->db;
		$q = $pdo->prepare("select * from usuario where id=:id");
		$q->execute($valores);
		$r=$q->fetch(PDO::FETCH_ASSOC);
			
		$valores=array('usuario'=>$r);
		echo $twig->render('usuario.php',$valores);  	
	}); 
	
	$app->post('/guardar', function() use ($app){
	
		global $twig;
		
		// Recogemos datos formulario de contacto
		
		$valores=array(
			'id'=>$app->request()->post('id'),
			'nombre'=>$app->request()->post('nombre'),
			'email'=>$app->request()->post('email'),		
			'rol'=>$app->request()->post('rol'),	
			
		);
		
		if($valores['id']){
			$sql = "update usuario set NOMBRE=:nombre, EMAIL=:email, CLAVE=:clave WHERE ID=:id";
			$pdo=$app->db;
			$q = $pdo->prepare($sql);
			$q->execute($valores);
			
			$app->redirect('/usuarios');
		}
		else
		{
			unset($valores['id']);
			
			$sql = "INSERT INTO usuario (nombre, email, clave) VALUES (:nombre, :email, :clave)";
			$pdo=$app->db;
			$q = $pdo->prepare($sql);
			$q->execute($valores);
		
		$app->redirect('/usuarios');
		
		}
	}); 

	$app->get('/crear', function() use ($app){
		global $twig;
		// TODO indicar la vista a renderizar (aun no existe el formulario)
		echo $twig->render('usuario.php');  
	}); 
});

$app->get('/contartabla','Login::forzarLogin', function() use ($app){
	
		global $twig;
		
		$pdo=$app->db;
		$q = $pdo->prepare("select count(*) numero from tablasbd");
		$q->execute();
		$r=$q->fetch(PDO::FETCH_ASSOC);
			
		echo "Hay ". $r['numero'] . " tablas.";
});

$app->get('/about','Login::forzarLogin', function() use ($app){
	global $twig;
	echo $twig->render('about.php');  
}); 

$app->get('/logout', function () use ($app) {
		Login::forzarLogOut();
});
	
$app->group('/usuarios', function () use ($app) {
	
	$app->get('/recuperar', function() use ($app){
	    Utilidades::getLogger()->debug('Debemos implementar cómo recuperar la contraseña de un usuario.');
	});
	
});



$app->group('/login', function () use ($app) {
	
	$app->get('/', function() use ($app){
		global $twig;
		if (LoginClave::isLogged())
			$app->redirect('/');
		else
			echo $twig->render('login.php');  
	}); 

	$app->post('/', function() use ($app){
		global $twig;
		
		if(LoginClave::autenticar($app->db,$app->request()->post('nombre'), $app->request()->post('clave'))){
			$app->redirect('/');
		}
		else{
			
			$valores=array(
			    "error"=>"Usuario/clave incorrectos...",
				"email"=>$app->request()->post('nombre')
			);
			
			if (Usuario::existe($valores['email']))
			{
				$url=Utilidades::protegerURL('/usuario/recuperar?email='.$valores['email']);
				$valores['error']="Usuario/clave incorrectos... ¿Desea <a href='.$url.'>recuperar su contraseña</a>?";
			}
			
			echo $twig->render('login.php',$valores);
		}
	});
});

// TODO cambiar a un sitio más conveniente
function import_csv_to_sqlite(&$pdo, $csv_path, $options = array()){
	
	extract($options);
	
	if (($csv_handle = fopen($csv_path, "r")) === FALSE)
		throw new Exception('Cannot open CSV file');
		
	if(!$delimiter)
		$delimiter = ';';
		
	$table = (isset($table) && !empty($table)) ? $table : preg_replace("/[^A-Z0-9_]/i", '', basename($csv_path));
	
	
	if(!isset($fields)){
		$fields = array_map(function ($field){
			return strtolower(preg_replace("/[^A-Z0-9_]/i", '', $field));
		}, fgetcsv($csv_handle, 0, $delimiter));
	}
	
	$create_fields_str = join(', ', array_map(function ($field){
		return "$field TEXT NULL";
	}, $fields));
	
	$pdo->beginTransaction();
	
	$create_table_sql = "CREATE TABLE IF NOT EXISTS $table ($create_fields_str)";
	$pdo->exec($create_table_sql);
	
	$insert_fields_str = join(', ', $fields);
	$insert_values_str = join(', ', array_fill(0, count($fields),  '?'));
	$insert_sql = "INSERT INTO $table ($insert_fields_str) VALUES ($insert_values_str)";
	$insert_sth = $pdo->prepare($insert_sql);
	
	$inserted_rows = 0;
	while (($data = fgetcsv($csv_handle, 0, $delimiter)) !== FALSE) {
		$insert_sth->execute($data);
		$inserted_rows++;
	}
	
	$pdo->commit();
	
	fclose($csv_handle);
	
	return array(
			/*'table' => $table,
			'fields' => $fields,
			'insert' => $insert_sth,*/
			'table' => $table,
			'inserted_rows' => $inserted_rows
	);
}

$app->get('/contarFicheros','Login::forzarLogin', function() use ($app){
	
	global $twig;
	
	$directory = "./model/scripts/";
	$filecount = 0;
	$files = glob($directory . "*");
	if ($files){
	 $filecount = count($files);
	}
	
	$valores['message']="Hay $filecount ficheros en /model/scripts";
	echo $twig->render('inicio.php',$valores);
});

$app->get('/upload','Login::forzarLogin', function() use ($app){
    global $twig;
    echo $twig->render('upload.php');
}); 

$app->get('/bd','Login::forzarLogin', function() use ($app){
	
	global $twig;
	
	$directory = "./model/dictados.db";
	$filecount = 0;
	$files = glob($directory . "*");
	if ($files){
	 $filecount = count($files);
	}
	
	$valores['message']="Hay $filecount ficheros dictados.db";
	echo $twig->render('inicio.php',$valores);
});

// TODO cambiar a un sitio más conveniente
function upload_file(){
		$target_dir = "model/datos/";
	$target_file = $target_dir .basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtoupper(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image

	/*if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
		    echo "File is an image - " . $check["mime"] . ".";
		    $uploadOk = 1;
		} else {
		    echo "File is not an image.";
		    $uploadOk = 0;
		}
	}*/

	// Check if file already exists
	if (file_exists($target_file)) {
		// TODO quitar esto de aquí
		
		/*echo "Sorry, file already exists.";*/
		
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
		// TODO quitar esto de aquí
		
		/*echo "Sorry, your file is too large.";*/
		
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "CSV") {
		// TODO quitar esto de aquí
		
		/*echo "Sorry, only CSV files are allowed.;"*/
		
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		// TODO quitar esto de aquí
		
		/*echo "Sorry, your file was not uploaded.";*/
		
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			// TODO quitar esto de aquí
			
		    /*echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";*/
		    
		} else {
			// TODO quitar esto de aquí
			
		    /*echo "Sorry, there was an error uploading your file.";*/
		    
		}
	}
	
	return $target_file;
}  


$app->group('/email', function () use ($app) {
	
	$app->get('/','Login::forzarLogin', function() use ($app){
		global $twig;

		$valores=array(
			'pregunta'=>'Consideras que se debe expulsar a <strong>Jose Antonio Sánchez (2º BACH A)</strong> por acumulación de partes en menos de un mes',
			'aceptar' => array('texto'=>'Sí',
							   'url'=>Utilidades::getCurrentUrl(false).'/email/aceptar'),
			'cancelar' => array('texto'=>'No',
							   'url'=>Utilidades::getCurrentUrl(false).'/email/cancelar')
		);
		
		if(Email::enviar("jasvazquez@gmail.com","Prueba email",$twig->render('emailSiNo.php', $valores))){
			$valores['message']='Email enviado con éxito';
			echo $twig->render('inicio.php', $valores);
		}
	}); 
	
	$app->get('/aceptar', function() use ($app){
		global $twig;
		$valores['message']='Procedemos <strong>a tramitar</strong> la expulsión';
		echo $twig->render('inicio.php', $valores);
	});

	$app->get('/cancelar', function() use ($app){
		global $twig;
		$valores['message']='<strong>Anulamos </strong> la expulsión';
		echo $twig->render('inicio.php', $valores);
	});
});

$app->get('/anotalog','Login::forzarLogin', function() use ($app){
	    Utilidades::getLogger()->debug('prueba');
});	
	
$app->get('/crearTabla','Login::forzarLogin', function() use ($app){
	global $twig;
	$pdo=$app->db;
	$q = $pdo->prepare('CREATE TABLE accion ("ID_USUARIO" TEXT DEFAULT (1),"ID" INTEGER,"FECHA" TEXT,"RUTA" TEXT)');
	$q->execute();

	$valores['message']='Tabla creada sin problemas';
	echo $twig->render('inicio.php',$valores);
});

$app->get('/validar','Login::forzarLogin', function() use ($app){
	
	$usernameValidator = v::alnum()->noWhitespace()->length(1,5);
	
	if($usernameValidator->validate("justo"))
		echo  "Tamaño correcto";
	else
		echo  "Tamaño anómalo";
	
	echo "<br>";
	
	if($usernameValidator->validate("demasiado grande"))
		echo  "Tamaño correcto";
	else
		echo  "Tamaño anómalo";
}); 

$app->get('/drive','Login::forzarLogin', function() use ($app){
	global $twig;
	ParteIncidencia::generarCarta('alumno díscolo',['Correr por los pasillos.','Golpear a un compañero en la huida.']);
	
	$valores['message']='Acceso a Drive correcto';
	echo $twig->render('inicio.php',$valores);
				
});

$app->group('/test', function () use ($app) {
	
	$app->get('/326','Login::forzarLogin', function() use ($app){
		global $twig;
		echo $twig->render('malandrin.php'); 
	});
});

// Ponemos en marcha el router
$app->run();

?>
