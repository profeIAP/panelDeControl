
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

session_cache_limiter(false);	
session_start();
header('Content-type: text/html; charset=utf-8');

require 	 	'vendor/autoload.php';
require_once	'controller/Utils.php';

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
	
$app->get('/', function() use ($app){
    global $twig;
    echo $twig->render('inicio.php');  
}); 

$app->get('/hash',function() use ($app){
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


$app->group('/alumnos', function () use ($app) {
	
	
	$app->get('/importar', function() use ($app){
    global $twig;
    $valores=import_csv_to_sqlite($app->db, "./model/datos/alumnos", array("delimiter"=>","));
    echo $twig->render('importar.php',$valores);
      
}); 
    $app->get('/', function() use ($app){
		global $twig;
		
		$pdo=$app->db;
		$r = $pdo->query("select id, nombre, email, direccion, telefono, comentario, localidad, provincia, dni_tutor, curso from alumno")->fetchAll(PDO::FETCH_ASSOC);
			
		$valores=array('comentarios'=>$r);
		echo $twig->render('comentarios.php',$valores);  
	}); 
	
	$app->group('/buscar', function () use ($app) {
		$app->get('/nombre', function() use ($app){
			global $twig;
			echo "hola";
		}); 
	});
	
	
	$app->group('/anotaciones', function () use ($app) {
		$app->get('/', function() use ($app){
			global $twig;
			// Espacio "dedicado" a juan carlos
		}); 
	});
	
	$app->get('/borrar', function() use ($app){
	
		global $twig;
		
		$valores=array(
			"id"=>$app->request()->get('id')
		);
		
		$sql = "delete from alumno WHERE ID=:id";
		$pdo = $app->db;
		$q   = $pdo->prepare($sql);
		$q->execute($valores);
		$app->redirect('/');
	}); 
	
	$app->get('/editar', function() use ($app){
	
		global $twig;
		
		$valores=array(
			"id"=>$app->request()->get('id')
		);
		
		$pdo=$app->db;
		$q = $pdo->prepare("select * from alumno where id=:id");
		$q->execute($valores);
		$r=$q->fetch(PDO::FETCH_ASSOC);
			
		$valores=array('comentario'=>$r);
		echo $twig->render('/alumnos',$valores);  	
	}); 
	
	$app->post('/guardar', function() use ($app){
	
		global $twig;
		
		// Recogemos datos formulario de contacto
		
		$valores=array(
			'id'=>$app->request()->post('id'),
			'nombre'=>$app->request()->post('nombre'),
			'email'=>$app->request()->post('email'),		
			'direccion'=>$app->request()->post('direccion'),	
			'telefono'=>$app->request()->post('telefono'),	
			'comentario'=>$app->request()->post('comentario'),
			'localidad'=>$app->request()->post('localidad'),		
			'provincia'=>$app->request()->post('provincia'),	
			'dni_tutor'=>$app->request()->post('dni_tutor'),	
			'curso'=>$app->request()->post('curso')
		);
		
		if($valores['id']){
			$sql = "update alumno set NOMBRE=:nombre, EMAIL=:email, DIRECCION=:direccion, TELEFONO=:telefono, COMENTARIO=:comentario, LOCALIDAD=:localidad, PROVINCIA=:provincia, DNI_TUTOR=:dni_tutor, CURSO=:curso WHERE ID=:id ";
			$pdo=$app->db;
			$q = $pdo->prepare($sql);
			$q->execute($valores);
			
			$app->redirect('/usuarios');
		}
		else
		{
			unset($valores['id']);
			
			$sql = "INSERT INTO alumno (nombre, email, direccion, telefono, comentario, localidad, provincia, dni_tutor, curso) VALUES (:nombre, :email, :direccion, :telefono, :comentario, :localidad, :provincia, :dni_tutor, :curso)";
			$pdo=$app->db;
			$q = $pdo->prepare($sql);
			$q->execute($valores);
		
			// Mostramos un mensaje al usuario
			
			$app->redirect('/usuarios');
		}
	}); 

	$app->get('/crear', function() use ($app){
		global $twig;
		echo $twig->render('alumno.php');  
	}); 
});

$app->group('/notificaciones', function () use ($app) {
	
	$app->get('/', 'Utilidades::registrarAccion', function() use ($app){
		global $twig;
		
		$pdo=$app->db;
		$r = $pdo->query("select * from notificacion")->fetchAll(PDO::FETCH_ASSOC);
			
		$valores=array('notificaciones'=>$r);
		echo $twig->render('notificaciones.php',$valores);  
		
	}); 
	
	$app->get('/rss', function() use ($app){
		global $twig;
     
		 $pdo=$app->db;
		 #$app->response->headers->set('Content-Type', 'text/xml');
		 
		 $r = $pdo->query("select * from notificacion")->fetchAll(PDO::FETCH_ASSOC);
			
		echo $twig->render('rss.php', array('items' => $r));
	});

});

$app->group('/partes', function () use ($app) {
	
	$app->get('/', function() use ($app){
		global $twig;
		echo $twig->render('partes.php');  
	}); 

	$app->get('/crear', function() use ($app){
		global $twig;
		echo $twig->render('parte.php');  
	}); 
});

$app->group('/usuarios', function () use ($app) {
	
    $app->get('/', function() use ($app){
		global $twig;
		
		$pdo=$app->db;
		$r = $pdo->query("select id, nombre, email, clave from usuario")->fetchAll(PDO::FETCH_ASSOC);
			
		$valores=array('usuario'=>$r);
		echo $twig->render('comentarios.php',$valores);  
	}); 
	
	//cambiar alumno por usuario
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
	
	$app->get('/editarusuario', function() use ($app){
	
		global $twig;
		
		$valores=array(
			"id"=>$app->request()->get('id')
		);
		
		$pdo=$app->db;
		$q = $pdo->prepare("select * from usuario where id=:id");
		$q->execute($valores);
		$r=$q->fetch(PDO::FETCH_ASSOC);
			
		$valores=array('usuario'=>$r);
		echo $twig->render('alumno.php',$valores);  	
	}); 
	
	$app->post('/guardar', function() use ($app){
	
		global $twig;
		
		// Recogemos datos formulario de contacto
		
		$valores=array(
			'id'=>$app->request()->post('id'),
			'nombre'=>$app->request()->post('nombre'),
			'email'=>$app->request()->post('email'),		
			'clave'=>$app->request()->post('clave'),	
			
		);
		
		if($valores['id']){
			$sql = "update usuario set NOMBRE=:nombre, EMAIL=:email, CLAVE=:clave WHERE ID=:id";
			$pdo=$app->db;
			$q = $pdo->prepare($sql);
			$q->execute($valores);
			
			$app->redirect('/comentariosusuario');
		}
		else
		{
			unset($valores['id']);
			
			$sql = "INSERT INTO usuario (nombre, email, clave) VALUES (:nombre, :email, :clave)";
			$pdo=$app->db;
			$q = $pdo->prepare($sql);
			$q->execute($valores);
		
			// Mostramos un mensaje al usuario
			
			echo $twig->render('agradecimiento.php',$valores); 
		}
	}); 

	$app->get('/crear', function() use ($app){
		global $twig;
		// TODO indicar la vista a renderizar (aun no existe el formulario)
		echo $twig->render('');  
	}); 
});
$app->get('/contartabla', function() use ($app){
	
		global $twig;
		
		$pdo=$app->db;
		$q = $pdo->prepare("select * from tablasbd");
		$q->execute();
		$r=$q->fetch(PDO::FETCH_ASSOC);
			
		$valores=array('ntablas'=>$r);
		echo $twig->render('tablas.php',$valores);  	
	});
$app->get('/about', function() use ($app){
	global $twig;
	echo $twig->render('about.php');  
}); 
 
function import_csv_to_sqlite(&$pdo, $csv_path, $options = array()){
	
	extract($options);
	
	if (($csv_handle = fopen($csv_path, "r")) === FALSE)
		throw new Exception('Cannot open CSV file');
		
	if(!$delimiter)
		$delimiter = ';';
		
	$table = (isset($table) && !empty($table)) ? $table : preg_replace("/[^A-Z0-9]/i", '', basename($csv_path));
	
	if(!isset($fields)){
		$fields = array_map(function ($field){
			return strtolower(preg_replace("/[^A-Z0-9]/i", '', $field));
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


$app->get('/contarFicheros', function() use ($app){
	$directory = "./model/scripts/";
	$filecount = 0;
	$files = glob($directory . "*");
	if ($files){
	 $filecount = count($files);
	}
	echo "There were $filecount files";
});

$app->get('/grafica', function() use ($app){
    global $twig;
    echo $twig->render('grafica.php');  
}); 


$app->get('/upload', function() use ($app){
    global $twig;
    echo $twig->render('upload.php');
}); 

$app->post('/upload', function() use ($app){
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
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "CSV") {
    echo "Sorry, only CSV files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
	}); 

// Ponemos en marcha el router
$app->run();

?>
