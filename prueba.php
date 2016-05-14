<?php
require __DIR__ . '/vendor/autoload.php';

const FROM_EMAIL = "jasvazquez@iesalandalus.com";
const FROM_NAME  = "profeIAP";
	
define('APPLICATION_NAME', 'Gmail API PHP Quickstart');
define('CREDENTIALS_PATH', '~/.credentials/gmail-php-quickstart.json');
define('CLIENT_SECRET_PATH', __DIR__ . '/client_secret.json');
// If modifying these scopes, delete your previously saved credentials
// at ~/.credentials/gmail-php-quickstart.json
define('SCOPES', implode(' ', array(
  //Google_Service_Gmail::GMAIL_READONLY,
  'https://mail.google.com/')
));

if (php_sapi_name() != 'cli') {
  throw new Exception('This application must be run on the command line.');
}

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient() {
  $client = new Google_Client();
  $client->setApplicationName(APPLICATION_NAME);
  $client->setScopes(SCOPES);
  $client->setAuthConfigFile(CLIENT_SECRET_PATH);
  $client->setAccessType('offline');

  // Load previously authorized credentials from a file.
  $credentialsPath = expandHomeDirectory(CREDENTIALS_PATH);
  if (file_exists($credentialsPath)) {
    $accessToken = file_get_contents($credentialsPath);
  } else {
    // Request authorization from the user.
    $authUrl = $client->createAuthUrl();
    printf("Open the following link in your browser:\n%s\n", $authUrl);
    print 'Enter verification code: ';
    $authCode = trim(fgets(STDIN));

    // Exchange authorization code for an access token.
    $accessToken = $client->authenticate($authCode);

    // Store the credentials to disk.
    if(!file_exists(dirname($credentialsPath))) {
      mkdir(dirname($credentialsPath), 0700, true);
    }
    file_put_contents($credentialsPath, $accessToken);
    printf("Credentials saved to %s\n", $credentialsPath);
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
function expandHomeDirectory($path) {
  $homeDirectory = getenv('HOME');
  if (empty($homeDirectory)) {
    $homeDirectory = getenv("HOMEDRIVE") . getenv("HOMEPATH");
  }
  return str_replace('~', realpath($homeDirectory), $path);
}

function sendMessage($to, $subject, $body) {
	
	// Get the API client and construct the service object.
	
	$client = getClient();
	$service = new Google_Service_Gmail($client);

	$mail = new PHPMailer();
	
	$mail->CharSet = "ISO-8859-1";
	$mail->From = FROM_EMAIL;
	$mail->FromName = FROM_NAME;
	$mail->AddAddress($to);
	$mail->AddReplyTo(FROM_EMAIL,FROM_NAME);
	$mail->Subject = $subject;
	// TODO admitir html en lugar de texto plano
	$mail->Body    = $body;
	$mail->preSend();
	$mime = $mail->getSentMIMEMessage();
	$m = new Google_Service_Gmail_Message();
	$data = base64_encode($mime);
	$data = str_replace(array('+','/','='),array('-','_',''),$data); // url safe
	$m->setRaw($data);
	$service->users_messages->send('me', $m);
}

// [https://goo.gl/QZIHWU] Para descargar el fichero de credenciales client_id.json
sendMessage("jasvazquez@gmail.com", "Prueba brutal","Como funcione <b>me muero</b>");

?>
