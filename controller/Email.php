<?php

use Respect\Validation\Validator as v;

require getcwd().'/vendor/autoload.php';
	
define('APPLICATION_NAME', 'Gmail API PHP Quickstart');
define('CREDENTIALS_PATH', '~/.credentials/gmail-php-quickstart.json');
// https://console.cloud.google.com para obtener el fichero client_secret.json
define('CLIENT_SECRET_PATH', getcwd().'/client_secret.json');

// If modifying these scopes, delete your previously saved credentials at ~/.credentials/gmail-php-quickstart.json 

define('SCOPES', implode(' ', array(
  'https://mail.google.com/')
));

// Documentación Swift_Message [http://goo.gl/Z12Bo]
	
class Email {

	// MEJORA meter en un fichero único de configuración
	
	const ADMIN_EMAIL 	= "jasvazquez@iesalandalus.com";
	const FROM_EMAIL	= "jasvazquez@iesalandalus.com";
	const FROM_NAME		= "profeIAP";	
	
    public static function enviar($to, $subject, $body) {
		
		if(Utilidades::isEntorno(Utilidades::ENTORNO_DESARROLLO))
			self::enviarGMail($to, $subject, $body);
		else
			self::enviarProduccion($to, $subject, $body);
	}
	
	private static function enviarProduccion($to, $subject, $body){
		
		$headers = "From: ".self::FROM_EMAIL."\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		mail($to, $subject, $body, $headers);
	}
	
	private static function enviarDesarrollo($to, $subject, $body){
		
		// Cliente Android usa los hosts 
		// www.googleapis.com:443 y mail.google.com:443
		// Y FUNCIONA EN EL INSTITUTO
		
		// [https://goo.gl/z5lDLV] Para el uso de Google APIs
		
		// [https://goo.gl/JY8Ll] Técnicamente los puertos son 
		// TLS/STARTTLS: 587 y SSL: 465
		
		// TODO quitar clave email de aquí

		$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, "ssl")
		  ->setUsername('TU_CORREO@gmail.com')
		  ->setPassword('CLAVE_ULTRA_SECRETA');

		$mailer = Swift_Mailer::newInstance($transport);

		$message = Swift_Message::newInstance($subject)
		  ->setFrom(array(self::FROM_EMAIL => self::FROM_NAME))
		  ->setTo(array($to))
		  ->addPart($body, 'text/html');

		$result = $mailer->send($message);
	}
	
	public static function enviarGMail($to, $subject, $body) {
	
		// Get the API client and construct the service object.
		
		$client = self::getClient(null);
		if(is_null($client)) return;
		
		$service = new Google_Service_Gmail($client);

		$mail = new PHPMailer();
		
		$mail->CharSet = "ISO-8859-1";
		$mail->From = self::FROM_EMAIL;
		$mail->FromName = self::FROM_NAME;
		$mail->AddAddress($to);
		$mail->AddReplyTo(self::FROM_EMAIL,self::FROM_NAME);
		$mail->Subject = $subject;
		$mail->Body    = $body;
		$mail->IsHTML(true); 
		$mail->preSend();
		$mime = $mail->getSentMIMEMessage();
		$m = new Google_Service_Gmail_Message();
		$data = base64_encode($mime);
		$data = str_replace(array('+','/','='),array('-','_',''),$data); // url safe
		$m->setRaw($data);
		$service->users_messages->send('me', $m);
	}
	
	public static function getMessageAutenticacion($to, $token) {

		return 'Ha recibido el siguiente mensaje porque alguien ha solicitado acceder a la web <b><a href="http://localhost:9000">AlDictado</a></b> con su dirección de correo electrónico<br><br>'
			.  'Si ha sido ud. pulse el siguiente <a href="'.Utilidades::getCurrentUrl(false).'/usuario/autenticar/'.$token.'?email='.$to.'">enlace para entrar</a>.<br>'
			.  'En caso contrario, ignore este correo.<br><br>'
			.  'Gracias por su atención.';
	}
	
	public static function getMessageDictadosTerminados($email) {

		return "El usuario $email ha realizado todos los dictados existentes en la BD<br>"
			. "Deberíamos crear alguno nuevo para que no se 'aburra'.<br>"
			. "¿No te parece?";
	}
	
	public static function getMessageActividadSospechosa($email, $donde) {

		return "El usuario $email está realizando actividades extrañas en <b>'$donde'</b>";
	}

	/**
	 * Returns an authorized API client.
	 * @return Google_Client the authorized client object
	 */
	 
	// [https://goo.gl/QZIHWU] Para descargar el fichero de credenciales client_id.json
	
	public static function getClient($authCode) {
	  
	  $dir=__DIR__.'/logs';
	  $logger = new Katzgrau\KLogger\Logger($dir);
	  $logger->debug('HOLA');
	
	  $client = new Google_Client();
	  $client->setApplicationName(APPLICATION_NAME);
	  $client->setScopes(SCOPES);
	  $client->setAuthConfigFile(CLIENT_SECRET_PATH);
	  $client->setAccessType('offline');

	  // Load previously authorized credentials from a file.
	  $credentialsPath = self::expandHomeDirectory(CREDENTIALS_PATH);
	  if (file_exists($credentialsPath)) {
		$accessToken = file_get_contents($credentialsPath);
	  } else {
		
		if (!isset($authCode)){
			$app = \Slim\Slim::getInstance();
			global $twig;
			
			$authUrl = $client->createAuthUrl();
			
			$valores=array('url'=>$authUrl);
			echo $twig->render('auth.php',$valores);  
			return;
		}else{
			// Exchange authorization code for an access token.
			$accessToken = $client->authenticate($authCode);

			// Store the credentials to disk.
			if(!file_exists(dirname($credentialsPath))) {
			  mkdir(dirname($credentialsPath), 0700, true);
			}
			
			file_put_contents($credentialsPath, $accessToken);
		}
	}
	  
	  $client->setAccessToken($accessToken);

		// Refresh the token if it's expired.
		if ($client->isAccessTokenExpired()) {
			$client->refreshToken($client->getRefreshToken());
			file_put_contents($credentialsPath, $client->getAccessToken());
		}
		
		return $client;
	}

	/**
	 * Expands the home directory alias '~' to the full path.
	 * @param string $path the path to expand.
	 * @return string the expanded path.
	 */
	public static function expandHomeDirectory($path) {
	  $homeDirectory = getenv('HOME');
	  if (empty($homeDirectory)) {
		$homeDirectory = getenv("HOMEDRIVE") . getenv("HOMEPATH");
	  }
	  return str_replace('~', realpath($homeDirectory), $path);
	}   
}

?>
