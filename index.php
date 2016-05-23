
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
require_once	'controller/Email.php';
require_once	'controller/LoginClave.php';

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
	
	$app->post('/importar', function() use ($app){
		global $twig;
		$fichero=upload_file();
		$valores=import_csv_to_sqlite($app->db, $fichero, array("delimiter"=>",", "table"=>"alumno"));
		echo $twig->render('importar.php',$valores);
		unlink($fichero);
		  
	}); 
	
	$app->get('/importar', function() use ($app){
    global $twig;
    echo $twig->render('upload.php');
}); 
	
    $app->get('/', function() use ($app){
		global $twig;
		
		$pdo=$app->db;
		$r = $pdo->query("select id, nombre, email, direccion, telefono, comentario, localidad, provincia, dni_tutor, curso from alumno")->fetchAll(PDO::FETCH_ASSOC);
			
		$valores=array('alumnos'=>$r);
		echo $twig->render('alumnos.php',$valores);  
	}); 
	
	$app->group('/buscar', function () use ($app) {
		$app->get('/nombre', function() use ($app){
			global $twig;
			
			$pdo=$app->db;
			
			$statement=$pdo->prepare("SELECT nombre FROM alumno where nombre like '%sánchez%'");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_COLUMN, 0);
			$json= json_encode($results);
			
			echo $json;
		});
		
		$app->post('/id', function() use ($app){
			global $twig;
			$miArray = array("nombre"=>"julio", "materno"=>"madre julio", "paterno"=>"padre julio");
            echo json_encode($miArray);
			
		}); 
	});
	
	$app->group('/anotaciones', function () use ($app) {
		$app->get('/', function() use ($app){
			global $twig;
			// Espacio "dedicado" a juan carlos
		}); 
		$app->get('/crear', function() use ($app){
			global $twig;
			echo $twig->render('anotacion.php'); 
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
		echo $twig->render('/usaurios',$valores);  	
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
			
			$app->redirect('/alumnos');
		}
		else
		{
			unset($valores['id']);
			
			$sql = "INSERT INTO alumno (nombre, email, direccion, telefono, comentario, localidad, provincia, dni_tutor, curso) VALUES (:nombre, :email, :direccion, :telefono, :comentario, :localidad, :provincia, :dni_tutor, :curso)";
			$pdo=$app->db;
			$q = $pdo->prepare($sql);
			$q->execute($valores);
		
			// Mostramos un mensaje al usuario
			
			$app->redirect('/alumnos');
		}
	}); 

	$app->get('/crear', function() use ($app){
		global $twig;
		echo $twig->render('alumno.php');  
	}); 

}); 

	$app->get('/autocompletado', function() use ($app){
		global $twig;
		echo $twig->render('autocomplete.php');  
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

	$app->post('/guardar', function() use ($app){
	
		global $twig;
		
		// Recogemos datos formulario de contacto
		
		$valores=array(
			'id'=>$app->request()->post('id'),
			'id_alumno'=>$app->request()->post('nombre'),
			'grupo'=>$app->request()->post('grupo'),		
			'fecha'=>$app->request()->post('fecha'),	
			'hora'=>$app->request()->post('hora'),	
			'asignatura'=>$app->request()->post('asignatura'),	
			'profesor'=>$app->request()->post('profesor'),	
			'l_pertubar'=>$app->request()->post('l_pertubar'),	
			'l_dificultar'=>$app->request()->post('l_dificultar'),
			'l_faltarinjustificadamente'=>$app->request()->post('l_faltarinjustificadamente'),
			'l_deteriorar'=>$app->request()->post('l_deteriorar'),		
			'l_movil'=>$app->request()->post('l_movil'),	
			'l_gafas'=>$app->request()->post('l_gafas'),	
			'l_gorra'=>$app->request()->post('l_gorra'),
			'l_pasillos'=>$app->request()->post('l_pasillos'),	
			'l_faltainjustificada'=>$app->request()->post('l_faltainjustificada'),
			'l_nocolaborar'=>$app->request()->post('l_nocolaborar'),
			'l_impuntual'=>$app->request()->post('l_impuntual'),		
			'l_desconsiderables'=>$app->request()->post('l_desconsiderables'),	
			'l_beberocomer'=>$app->request()->post('l_beberocomer'),	
			'l_faltamaterial'=>$app->request()->post('l_faltamaterial'),
			'l_ordenador'=>$app->request()->post('l_ordenador'),	
			'l_alterar'=>$app->request()->post('l_alterar'),
			'l_fumar'=>$app->request()->post('l_fumar'),
			'l_usoindebido'=>$app->request()->post('l_usoindebido'),
			'g_agresion'=>$app->request()->post('g_agresion'),			
			'g_incumplimiento'=>$app->request()->post('g_incumplimiento'),	
			'g_amenazas'=>$app->request()->post('g_amenazas'),	
			'g_suplantacion'=>$app->request()->post('g_suplantacion'),
			'g_fumar'=>$app->request()->post('g_fumar'),
			'g_ofensas'=>$app->request()->post('g_ofensas'),	
			'g_humillaciones'=>$app->request()->post('g_humillaciones'),	
			'g_deterioro'=>$app->request()->post('g_deterioro'),
			'g_impedimento'=>$app->request()->post('g_impedimento')
		);
		
		if($valores['id']){
			$sql = "update alumno set ID_ALUMNO=:id_alumno, GRUPO=:grupo, FECHA=:fecha, HORA=:hora, ASIGNATURA=:asignatura, PROFESOR=:profesor, TUTOR=:tutor, L_PERTUBAR=:l_pertubar, L_DIFICULTAR=:l_dificultar, L_FALTARINJUSTIFICADAMENTE=:l_faltarinjustificadamente, L_DETERIORAR=:l_deteriorar, L_MOVIL=:l_movil, L_GAFAS=:l_gafas, L_GORRA=:l_gorra, L_PASILLOS=:l_pasillos, L_FALTAINJUSTIFICADA=:l_faltainjustificada, L_NOCOLABORAR=:l_nocolaborar, L_IMPUNTUAL=:l_impuntual, L_DESCONSIDERABLES=:l_desconsiderables, L_BEBEROCOMER=:l_beberocomer, L_FALTAMATERIAL=:l_faltamaterial, L_ORDENADOR=:l_ordenador, L_ALTERAR=:l_alterar, L_FUMAR=:l_fumar, L_USOINDEBIDO=:l_usoindebido, G_AGRESION=:g_agresion, G_INCUMPLIMIENTO=:g_incumplimiento, G_AMENAZAS=:g_amenazas, G_SUPLANTACION=:g_suplatancion, G_FUMAR=:g_fumar, G_OFENSAS=:g_ofensas, G_HUMILLACIONES=:g_humillaciones, G_DETERIORO=:g_deterioro, G_IMPEDIMENTO=:g_impedimento WHERE ID=:id ";
			$pdo=$app->db;
			$q = $pdo->prepare($sql);
			$q->execute($valores);
			
			$app->redirect('/partes');
		}
		else
		{
			unset($valores['id']);
			
			$sql = "INSERT INTO alumno (id_alumno, grupo, fecha, fecha, hora, asignatura, profesor, tutor, l_pertubar, l_dificultar, l_dificultar, l_faltarinjustificadamente, l_deteriorar, l_movil, l_gafas, l_gorra, l_pasillos, l_faltainjustificada, l_nocolaborar, l_impuntual, l_desconsiderables, l_beberocomer, l_faltamaterial, l_ordenador, l_alterar, l_fumar, l_usoindebido, g_agresion, g_incumplimiento, g_amenazas, g_suplantacion, g_fumar, g_ofensas, g_humillaciones, g_deterioro, g_impedimento) VALUES (:id_alumno, :grupo, :fecha, :hora, :asignatura, :profesor, :tutor, :l_pertubar, :l_dificultar, :l_faltarinjustificadamente, :l_deteriorar, :l_movil, :l_gafas, :l_gorra, :l_pasillos, :l_faltainjustificada, :l_nocolaborar, :l_impuntual, :l_desconsiderables, :l_beberocomer, :l_faltamaterial, :l_ordenador, :l_alterar, :l_fumar, :l_usoindebido, :g_agresion, :g_amenazas, :g_suplantacion, :g_fumar, :g_ofensas, :g_humillaciones, :g_deterioro, :g_impedimento)";
			$pdo=$app->db;
			$q = $pdo->prepare($sql);
			$q->execute($valores);
		
			// Mostramos un mensaje al usuario
			
			$app->redirect('/partes');
		}
 
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
			
		$valores=array('usuarios'=>$r);
		echo $twig->render('usuarios.php',$valores);  
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
		echo $twig->render('');  
	}); 
});

$app->get('/contartabla', function() use ($app){
	
		global $twig;
		
		$pdo=$app->db;
		$q = $pdo->prepare("select count(*) numero from tablasbd");
		$q->execute();
		$r=$q->fetch(PDO::FETCH_ASSOC);
			
		echo "Hay ". $r['numero'] . " tablas.";
});

$app->group('/partes', function () use ($app) {
	
	$app->get('/', function() use ($app){
		global $twig;
		
		$pdo=$app->db;
		$r = $pdo->query("select * from partes")->fetchAll(PDO::FETCH_ASSOC);
			
		$valores=array('comentarios'=>$r);
		echo $twig->render('partes.php',$valores);  
	}); 

	$app->get('/crear', function() use ($app){
		global $twig;
		echo $twig->render('parte.php');  
	}); 
});

$app->get('/about', function() use ($app){
	global $twig;
	echo $twig->render('about.php');  
}); 

$app->get('/login', function() use ($app){
    global $twig;
    echo $twig->render('login.php');  
}); 

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

$app->get('/login', function() use ($app){
    global $twig;
	if(LoginClave::autenticar("profeIAP", "clave"))
		echo "OK";
	else
		echo "!OK";
}); 

$app->get('/upload', function() use ($app){
    global $twig;
    echo $twig->render('upload.php');
}); 

$app->get('/Bd', function() use ($app){
	$directory = "./model/dictados.db";
	$filecount = 0;
	$files = glob($directory . "*");
	if ($files){
	 $filecount = count($files);
	}
	echo "Hay $filecount fichero dictados.db";
});

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

$app->get('/email', function() use ($app){
	Email::enviar("jasvazquez@gmail.com","Prueba email","Esto es una prueba <b>sencilla</b>");
    echo "enviado";
}); 

// Ponemos en marcha el router
$app->run();

?>
