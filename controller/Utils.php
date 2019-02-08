<?php

// Documentación Swift_Message [http://goo.gl/Z12Bo]
	
class Utilidades {
	
	const ENTORNO_DESARROLLO 	= 'localhost';
	const ENTORNO_PREPRODUCCION	= '0.0.0.0';
	const ENTORNO_PRODUCCION 	= 'panel.iesalandalus.com';

	// Devuelve el entorno actual
	
	public static function getEntorno() {
		switch ($_SERVER['SERVER_NAME']) {
		  case self::ENTORNO_DESARROLLO:
			return self::ENTORNO_DESARROLLO;
			break;
			// Equiparamos PRODUCCION Y PREPRODUCCION para que envíe los correos a quien corresponda
			// (y no todo al programador)
			// Este entorno se está utilizando en el aula mientras da problemas el servidor de PRODUCCIÓN
			// con tanta carga de trabajo
		  case self::ENTORNO_PREPRODUCCION:
			return self::ENTORNO_PRODUCCION;
			break;
		  case self::ENTORNO_PRODUCCION:
			return self::ENTORNO_PRODUCCION;
			break;
		  default:
			throw new Exception("Entorno de servidor desconocido. Compruebe que '".$_SERVER['SERVER_NAME']."' se encuentra entre los nombres de servidor indicados como entornos."); 
			break;
		}
	}
	
	public static function getFechaSistema(){
		return date('Y-m-d H:i:s');
	}
	
	// Indica si el array proporcionado es asociativo (key, value) o secuencial (values)
	private static function isAssoc($array){
		return count(array_filter(array_keys($array), 'is_string')) > 0;
	}
	
	// Pasa a mayúscula todas las entradas de un array
	// Si es un array asociativo, cambia las claves pero no los valores
	
	public static function array_ucase($array) {
		if(self::isAssoc($array))
			return array_change_key_case($array, CASE_UPPER);
		else
			return array_map("strtoupper", $array); 
	}
		
	// Devuelve un listado con los campos que ha enviado un formulario al controlador
	
	public static function getCamposFormulario($app, $ordenarCampos=false, $ucase=false) {
		$req = $app->request;
		$campos= array_keys($req->params());
		
		if($ordenarCampos) asort($campos,3);
		if($ucase) $campos=self::array_ucase($campos);
		
		return $campos;
	}
	
	public static function getDatosFormulario($app, $ordenarCampos=false, $ucase=false) {
		$req = $app->request;
		$campos= array_keys($req->params());
		
		if($ordenarCampos) asort($campos,3);
		foreach($campos as $c){
			$valores[($ucase?strtoupper($c):$c)]=$req->params($c);
		}
		
		return $valores;
	}
	
	// Indica si nos encontramos en el entorno que nos indican
	
	public static function isEntorno($entorno) {
		return self::getEntorno()==$entorno;
	}
	
	// Obtiene la url http[s] al servidor actual
	
	public static function getCurrentUrl($full = true) {
          return "http" . (($_SERVER['SERVER_PORT']==443) ? "s://" : "://") . $_SERVER['HTTP_HOST'];
    }
    
    // Obtiene la ruta solicitada en el servidor actual (con o sin los parámetros GET)
    
    public static function getCurrentURI($includeParams=false){
		$uri=$_SERVER["REQUEST_URI"];
		return ($includeParams?$uri:strtok($uri,'?'));
	}

    
    // Obtiene el ID de la sesión actual
	
	public static function getSessionID() {
		return session_id();
	}
	
	// Indica si la cadena suministrada es un JSON
	
	public static function isJson($string) {
		json_decode($string);
		return (json_last_error() == JSON_ERROR_NONE);
	}

	public static function generateUUID() {
		return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
			mt_rand( 0, 0xffff ),
			mt_rand( 0, 0x0fff ) | 0x4000,
			mt_rand( 0, 0x3fff ) | 0x8000,
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
		);
	}
	
	// Lista los campos que sobran (o faltan) entre el formulario y la BD
	//
	// Útil a la hora de comprobar si nos hemos equivocado al escribir el nombre
	// de alguno de ellos (typos), se nos ha olvidado alguno o hemos puesto alguno de más
	
	private static function crypto_rand_secure($min, $max) {
        $range = $max - $min;
        if ($range < 0) return $min; // not so random...
        $log = log($range, 2);
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
	}
	public static function compararCorrespondenciaCampos($app, $nombreTabla){
		
		$valores_bd= AccesoDatos::getCamposTabla($app->db, $nombreTabla, true);
		$valores_form=Utilidades::getCamposFormulario($app,true,true);
		
		$valores_faltan=array_diff($valores_bd, $valores_form);
		$valores_sobran=array_diff( $valores_form,$valores_bd);
		
		$rsdo="<br>Faltan:";
		$rsdo=$rsdo.self::prettyPrintJSON($valores_faltan);
		$rsdo=$rsdo."<br>Sobran:";
		$rsdo=$rsdo.self::prettyPrintJSON($valores_sobran); 
	
		return $rsdo;
	}
	public static function getToken($length){
		$token = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet.= "0123456789";
		for($i=0;$i<$length;$i++){
			$token .= $codeAlphabet[self::crypto_rand_secure(0,strlen($codeAlphabet))];
		}
		return $token;
	}
	
	// Formatea un objeto JSON para que resulte más sencillo su lectura
	// Añade al String generado, las etiquetas "<pre>" de HTML para que se muestre correctamente en pantalla
	
	public static function prettyPrintJSON($json){
		return "<PRE>".json_encode($json,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)."</PRE>";
	}
	
	// Intenta rellenar la lista de valores que espera la BD escribiendo los campos
	// con el uso de mayúsculas/minúsculas que se han usado en la tabla de la BD
	
	// Que el programador no tenga cuidado supone dos consultas a la BD por cada inserción (penaliza el rendimiento)
	
	public static function optimizarCorrespondenciaCampos($bd, $form){
		
		// Anotamos los que coinciden en ambos conjuntos
		
		$coinciden=array_intersect($bd, array_keys($form));
		
		foreach($coinciden as $c)
		{
			$rsdo[$c]=$form[$c];
		}
		
		// Buscamos los campos que faltan y que existen con un nombre escrito de otro modo
		
		$form_ucase=Utilidades::array_ucase(array_keys($form));
		
		foreach(array_diff($bd, array_keys($form)) as $c){
			echo strtoupper($c)."<br>";
			
			if(in_array(strtoupper($c), $form_ucase))
			{
				$pos_bd=array_search($c, $bd);
				$pos_fm=array_search(strtoupper($c),$form_ucase);
				
				$rsdo[$bd[$pos_bd]]=$form[array_keys($form)[$pos_fm]];
			}
		}
		
		return $rsdo;
	}
	
	public static function mostrarSessionID(){
		
		$app = \Slim\Slim::getInstance();
		global $twig;
		
		$valores=array(
				'id_sesion'=>self::getSessionID()
			);
		echo $twig->render('session.php',$valores);
	}
	
	public static function registrarAccion(){

		$app = \Slim\Slim::getInstance();
		$pdo=$app->db;
		$u=LoginClave::getUsuario();
				$id=$u->getID();
		$valores=array(
			'url'=>$app->request->getPathInfo(),
			'id_user'=>$id
		);
			
	 	$sql = "INSERT INTO accion (ruta, id_usuario) VALUES (:url, :id_user)";
		$pdo=$app->db;
		$q = $pdo->prepare($sql);
		$q->execute($valores);
	}
	
	public static function getLogger(){
		$dir=getcwd().'/logs';
		return new Katzgrau\KLogger\Logger($dir);
	}
	
	// [https://goo.gl/Yko3ke] Clase que encripta la url completa pero 
	// que no he visto hasta tener implementado este método
	
	public static function protegerURL($uri, $valores=[])
	{

		// Si viene un HASH descartamos proteger la url
		
		if (strpos($uri, 'hash=') !== false) {
			Utilidades::getLogger()->debug("Nos están proporcionando una url ya 'protegida'; la ignoramos");
			return $uri;
		}

		// Recuperamos las urls protegidas actualmente
		
		try
		{
			$urls=$_SESSION['urls_protected'];
		}
		catch(Exception $e)
		{
			$urls=[];
		}
		
		if(count($urls)>0)
			Utilidades::getLogger()->debug(count($_SESSION['urls_protected'])." URLs protegidas inicialmente");
		else
			Utilidades::getLogger()->debug("0 URLs protegidas inicialmente");
		
		// Nos aseguramos que no sea una $uri ya protegida
			
		// Si la $uri ya fue protegida eliminamos la entrada antigua y
		// le generamos un nuevo 'hash' (para que deje de ser válida y
		// entre en vigor la que acabamos de crear)
		
		// De este modo se evitan duplicidades que puedan agotar la memoria del servidor
		
		$protegida=self::existeProteccionURL($uri);
		if($protegida){
			unset($urls[$protegida]);
		}

		$uuid=self::generateUUID();
		$urls[$uuid]=$uri;
		
		// IDEA implementar modo de limitar el número de URLS anotadas (podrían
		// hundir el servidor solicitando muchas veces la misma página y, por tanto,
		// anotando siempre la misma url con distinto hash)
		
		$_SESSION['urls_protected']=$urls;
		
		Utilidades::getLogger()->debug(count($_SESSION['urls_protected'])." URLs protegidas finalmente");
		//Utilidades::getLogger()->debug("URLs protegidas ".Utilidades::prettyPrintJSON($_SESSION['urls_protected']));
		
		return self::addParamToURL($uri, "hash=$uuid");
	}
	
	/*
	 * Comprueba si ya existe una anotación de haber protegido la $uri solicitada.
	 * En caso de existir, devolverá el UUID de la $uri solicitada (o FALSE si no ha sido protegida previamente)
	 */
	 
	private static function existeProteccionURL($uri){
		
		$uuid='';
		
		try
		{
			$urls=$_SESSION['urls_protected'];
		}
		catch(Exception $e)
		{
			return false;
		}
		
		if(count($urls)==0)
		    return false;
		    
		foreach ($urls as $k => $v) {
			if($v==$uri){
				$uuid=$k;
				break;
			}
		}
		
		return ($uuid!=''?$uuid:false);
	}
	
	/*
	 * Comprueba que la URI del navegador es la anotada para el HASH que indica
	 */
	 
	public static function validarURL($req, $valores=[])
	{
		try
		{
			$urls=$_SESSION['urls_protected'];
		}
		catch(Exception $e)
		{
			$urls=[];
		}
		
		$hash=$req->get('hash');
		
		// Si no hay HASH no hay nada que validar, damos por buena la URL
		
		if(!isset($hash))
			return true;
		
		// Si hay HASH nos aseguramos que coincida la URL con la que dimos
		// en su momento con dicho HASH
		
		try
		{
			$params=$urls[$hash];
			$params=self::addParamToURL($params, "hash=$hash");
			
			// El HASH deja de ser válido tras ser "consumido" 
			// (tanto si acierta como si no)
			
			unset($urls[$hash]);
			$_SESSION['urls_protected']=$urls;
			
			//Utilidades::getLogger()->debug("URLS que quedan anotadas ".Utilidades::prettyPrintJSON($_SESSION['urls_protected']));
		}
		catch(Exception $e)
		{
			return false;
		}
			
		Utilidades::getLogger()->debug("Nos han invocado desde ".$_SERVER["REQUEST_URI"]." y hemos recuperado (para hash $hash) la siguiente url $params");
		return $params==$_SERVER["REQUEST_URI"];
	}
	
	/*
	 * Añade uno (o varios) parámetros al final de la $url proporcionada
	 * teniendo en cuenta tanto si tiene (como si no) parámetros ya
	 */
	public static function addParamToURL($url, $new_params=''){
		
		$query = parse_url($url, PHP_URL_QUERY);

		// Returns a string if the URL has parameters or NULL if not
		
		if ($query) {
			$url .= "&$new_params";
		} else {
			$url .= "?$new_params";
		}
		
		return $url;
	}
	
}

?>
