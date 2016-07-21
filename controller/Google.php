<?php 

require getcwd().'/vendor/autoload.php';

define('CREDENTIALS_PATH','~/.credentials/panelDeControl-googleOAuth.json');
define('APPLICATION_NAME','Gmail API PHP Quickstart');
// https://console.cloud.google.com para obtener el fichero client_secret.json
define('CLIENT_SECRET_FILE',getcwd().'/client_secret.json');

// [https://goo.gl/Lt3yv9] Los SCOPES de las distintas APIs
// If modifying these scopes, delete your previously saved credentials at ~/.credentials/panelDeControl-googleOAuth.json


define('SCOPES', implode(' ', array(
  'https://mail.google.com/', 
  'https://www.googleapis.com/auth/drive',	  
  'https://www.googleapis.com/auth/spreadsheets'
)));

// [https://goo.gl/Tv833H] Cambios de la Google API versión 1.0 a la 2.0	
// [https://goo.gl/T5g0nf] Ejemplos de uso
	
class Google {

	/**
	 * Returns an authorized API client.
	 * @return Google_Client the authorized client object
	 */
	 
	// [https://goo.gl/QZIHWU] Para descargar el fichero de credenciales client_id.json
	
	public static function getClient($authCode) {
	  
	  $client = new Google_Client();
	  $client->setApplicationName(APPLICATION_NAME);
	  $client->setScopes(SCOPES);
	  $client->setAuthConfigFile(CLIENT_SECRET_FILE);
	  $client->setAccessType('offline');
	  $client->setIncludeGrantedScopes(true);

	  // Load previously authorized credentials from a file.
	  $credentialsPath = self::expandHomeDirectory(CREDENTIALS_PATH);
	  if (file_exists($credentialsPath)) {
		$accessToken = file_get_contents($credentialsPath);
	  } else
	  {
		
		if (!isset($authCode)){
			
			// TODO esto debería ir fuera de aquí
			
			$app = \Slim\Slim::getInstance();
			global $twig;
			
			$authUrl = $client->createAuthUrl();
			
			$valores=array('url'=>$authUrl);
			echo $twig->render('auth.php',$valores);  
			return;
		}else{
			// Exchange authorization code for an access token.
			$accessToken = $client->authenticate($authCode);
			//print_r($accessToken);
			
			// Store the credentials to disk.
			if(!file_exists(dirname($credentialsPath))) {
			  mkdir(dirname($credentialsPath), 0700, true);
			}

			file_put_contents($credentialsPath, json_encode($accessToken,JSON_PRETTY_PRINT));
		}
	}
	  
	  $client->setAccessToken($accessToken);

		// Refresh the token if it's expired.
		if ($client->isAccessTokenExpired()) {
			$client->refreshToken($client->getRefreshToken());
			file_put_contents($credentialsPath, json_encode($client->getAccessToken(),JSON_PRETTY_PRINT));
		}
		
		return $client;
	}

	/**
	 * Expands the home directory alias '~' to the full path.
	 * @param string $path the path to expand.
	 * @return string the expanded path.
	 */
	private static function expandHomeDirectory($path) {
	  $homeDirectory = getenv('HOME');
	  if (empty($homeDirectory)) {
		$homeDirectory = getenv("HOMEDRIVE") . getenv("HOMEPATH");
	  }
	  return str_replace('~', realpath($homeDirectory), $path);
	}   
}

?>
