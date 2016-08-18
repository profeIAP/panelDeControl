<?php 

require_once('Google.php');

class GoogleDrive {
	
	// Obtenemos el contenido de un rango de celdas
	// [https://goo.gl/HS817X] Aquí vi la luz
	
	public static function getContenidoCeldas(){
		
		$client = Google::getClient(null);
		
		$service = new Google_Service_Sheets($client);
		
		$response = $service->spreadsheets_values->get('1ovWPiLh3RYUzwxhYP1z4NdRIAeWH_R42PijHGs3u-iU','B3:D5');
		$values = $response->getValues();


		if (count($values) == 0)
		  print "No data found.\n";
		else 
		  echo "<PRE>".json_encode($values,JSON_PRETTY_PRINT)."</PRE>";

	}
	
	public static function setContenidoCeldas(){
		
		$client = Google::getClient(null);
		
		$service = new Google_Service_Sheets($client);
		
		// Create the value range Object
		$valueRange= new Google_Service_Sheets_ValueRange();

		// You need to specify the values you insert
		$valueRange->setValues([[1,2,3],[4,5]]); 

		// Then you need to add some configuration
		$conf = ["valueInputOption" => "RAW"];

		// Update the spreadsheet
		$service->spreadsheets_values->update('1ovWPiLh3RYUzwxhYP1z4NdRIAeWH_R42PijHGs3u-iU','B3:D4', $valueRange, $conf);

	}
	
	
		
	// Cambiamos el nombre de una hoja de nuestro libro
	// Aprovechamos para aprender cómo hacerlo "por lotes"
	
	// [https://goo.gl/kZyc1G] Cómo realizar operaciones en lote
	// [https://goo.gl/5zOWzL] Operaciones permitidas en un proceso por lotes: updateSheetProperties, addSheet, appendCells, ...
	
	public static function crearHoja(){
		
		$client = Google::getClient(null);
		
		$service = new Google_Service_Sheets($client);
		
		$spreadsheetId = '1ovWPiLh3RYUzwxhYP1z4NdRIAeWH_R42PijHGs3u-iU';
		$requests = array();
		
		$requests[] = new Google_Service_Sheets_Request(array(
		  'addSheet' => array(
			'properties' => array('title' => 'Al final')
		  )
		));

		// ... Repetir tantos $requests[] = new Google_Service_Sheets_Request(..) como operaciones se deseen realizar
		
		$batchUpdateRequest = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest(array(
		  'requests' => $requests
		));

		$service->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);
	}
	
	public static function cambiarNombreHoja(){
		
		$client = Google::getClient(null);
		
		$service = new Google_Service_Sheets($client);
		
		$spreadsheetId = '1ovWPiLh3RYUzwxhYP1z4NdRIAeWH_R42PijHGs3u-iU';
		$requests = array();
		
		$requests[] = new Google_Service_Sheets_Request(array(
		  'updateSheetProperties' => array(
			'properties' => array('sheetId' => 0, 'title' => 'Nueva Hoja JASV'),
			'fields' => 'title'
		  )
		));
		
		

		// ... Repetir tantos $requests[] = new Google_Service_Sheets_Request(..) como operaciones se deseen realizar
		
		$batchUpdateRequest = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest(array(
		  'requests' => $requests
		));

		$service->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);
	}

	// Obtenemos una hoja de cálculo de Drive
	public static function getLibro(){
		
		$client = Google::getClient(null);
		
		$service = new Google_Service_Sheets($client);
		
		$ss = $service->spreadsheets->get('1h8mIJk_ph3WpYuHacqZe4sQRqIQfwL9XRg59frVtYHA');
		echo $ss->properties->title;
	}
	
	// Métodos y atributos de la API de Google [https://github.com/google/google-api-php-client-services/blob/master/Sheets/Spreadsheet.php]
	// Inspiración para su uso [http://stackoverflow.com/a/37861831]
	
	// Crea una hoja de cálculo 
	public static function crearLibro($nombre){
		
		$client = Google::getClient(null);
		
		$service = new Google_Service_Sheets($client);
		$props=array('properties'=>array('title'=>$nombre));
		$ss = $service->spreadsheets->create(new Google_Service_Sheets_Spreadsheet($props));
	}
	
	// Creación de directorios	
	public static function crearDirectorioDrive(){
		
		$client = Google::getClient(null);
		$service = new Google_Service_Drive($client);
		
		// [https://goo.gl/ZauFgg] Tipos MIME válidos
		
		// Folder 		application/vnd.google-apps.folder
		// Google Sheet	application/vnd.google-apps.spreadsheet
		
		$fileMetadata = new Google_Service_Drive_DriveFile(array(
		  'name' => 'InvoicesJASV',
		  'mimeType' => 'application/vnd.google-apps.spreadsheet'));
		  
		$file = $service->files->create($fileMetadata, array(
		  'fields' => 'id'));
		echo $file->id;
	}
	
	// Lista correctamente los ficheros en Drive
	
	public static function listarFicherosDrive(){
		
		$client = Google::getClient(null);
		$service = new Google_Service_Drive($client);
	      $results = $service->files->listFiles();
      if (count($results->getItems()) == 0) {
        echo "No files found.\n";
      } 
      else{
		  foreach($results->getItems() as $f){
			echo $f->getTitle()."<br>";
		}
	  }
	}
	
	// Sube a Drive el contenido del fichero indicado con $rutaFichero
	// y le asigna $nombre como nombre del fichero en Drive
	
	public static function subirFichero($nombre, $rutaFichero){
		
		$client = Google::getClient(null);
		$service = new Google_Service_Drive($client);
		
		$file = new Google_Service_Drive_DriveFile();
		$file->setName($nombre);
		$result = $service->files->create(
			$file,
			array(
				'data' => file_get_contents($rutaFichero),
				'mimeType' => 'application/octet-stream',
				'uploadType' => 'multipart'
			)
		);
		
		return  $result->id ;
		
	}
	
	public static function prueba(){
		self::subirFichero('fichero-subido.txt', '/tmp/prueba.txt');
	}
	
	// ¿¡¿ No existe API para Google Docs ?!?
	// [http://goo.gl/JSm4Sv] Cómo llamar a un Google Apps Script desde PHP
	// [https://goo.gl/hT35TS] ReplaceText usando Google Apps Script
}



?>
