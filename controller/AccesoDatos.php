<?php

class AccesoDatos{
	
	

	public static function borrar($pdo, $nombreTabla, $id){
		
		$valores=array(
			"id"=>$id
		);
		
		$sql = "delete from $nombreTabla WHERE ID=:id";
		$q   = $pdo->prepare($sql);
		$q->execute($valores);
	}
	
	/* Elimina todas las entradas de la tabla $NOMBRETABLA que cumplan la condición indicada en $WHERE */
	
	public static function eliminar($pdo, $nombreTabla, $where=""){
		
		
		Utilidades::getLogger()->debug("Invocado un AccesoDatos::eliminar('$nombreTabla', '$where');");	
		
		if(trim($where)!="")
			$where = "WHERE $where";
		
		$sql = "delete from $nombreTabla $where";
		$q   = $pdo->prepare($sql);
		$q->execute();
	}
	
	/* Obtiene el nombre de los campos que componen $nombreTabla */
	
	public static function getCamposTabla($pdo, $nombreTabla, $ordenarCampos=false){
		
		$q = $pdo->query("PRAGMA table_info($nombreTabla)");
		$columns = array();
		foreach ($q as $k) {
			$columns[] = $k['name'];
		}
		
		if($ordenarCampos) asort($columns,3);
		return $columns;
	}
	
	public static function guardar($pdo, $nombreTabla, $valores){
		
		// Distinguimos la operación a realizar
		
		if(isset($valores['ID']) && $valores['ID']){
			$sql=self::generarActualizacion($nombreTabla, $valores);
		}
		else
		{
			unset($valores['ID']);
			$sql=self::generarInsercion($nombreTabla, $valores);
		}
		
		Utilidades::getLogger()->Debug("AccesoDatos::guardar(): $sql");
		Utilidades::getLogger()->Debug("Datos usados: ".Utilidades::prettyPrintJSON($valores));
		
		// Lanzamos la operación contra la BD
		
		$q = $pdo->prepare($sql);
		$q->execute($valores);
		
		if(isset($valores['ID']) && $valores['ID'])
			return $valores['ID'];
		else
			return $pdo->lastInsertId();
		
	}
	
	public static function recuperar($pdo, $nombreTabla, $id){
		
		$valores=array(
			"id"=>$id
		);
		
		$q = $pdo->prepare("select * from $nombreTabla where id=:id");
		$q->execute($valores);
		
		return $q->fetch(PDO::FETCH_ASSOC);
	}

	/* Lanza la SQL directamente contra la BD */
	
	public static function ejecutar($pdo, $sql){
		$q = $pdo->prepare($sql);
		$q->execute();		
	}
	
    public static function buscar($pdo, $nombreTabla, $camposSelect="*", $where=""){
		
        if(trim($where)!="")
			$where = "WHERE $where";

		$sql="select $camposSelect from $nombreTabla $where";
		Utilidades::getLogger()->debug("Lanzamos SQL: $sql");
		
		$q = $pdo->prepare($sql);
		$q->execute();
		
		return $q->fetch(PDO::FETCH_ASSOC);
	}
	
	public static function listar($pdo, $nombreTabla, $camposSelect="*", $where=""){
		
		if(trim($where)!="")
			$where="WHERE $where";
		
		$sql="select $camposSelect from $nombreTabla $where";
		Utilidades::getLogger()->debug("Listamos la SQL $sql");
		
		return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
	}
	

	private static function generarActualizacion($nombreTabla, $valores){

		$sqlArray = array();		
		$sql  = "UPDATE $nombreTabla SET ";
	   
		foreach($valores as $column => $value){
			if($column <> 'ID')
				$sqlArray[] = "'$column' = :$column ";
		}
		$sql .= implode(', ', $sqlArray);
		$sql .= "WHERE ID = :ID";
	   
	   return $sql;
	}
	
	private static function generarInsercion($nombreTabla, $valores){
	   $sql  = "INSERT INTO $nombreTabla";
	   // Generamos la lista de campos
	   $sql .= " ('".implode("', '", array_keys($valores))."')";
	   // Generamos la lista de valores
	   $sql .= " VALUES (:".implode(", :", array_keys($valores)).") ";
	   
	   return $sql;
	}
}
?>
