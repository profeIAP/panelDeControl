<?php

use Zend\Permissions\Acl\Acl as ZendAcl;

// [https://goo.gl/FIO8M5] Zend ACL

class PermisosACL extends ZendAcl
{
	protected $defaultPrivilege = array('ejecutar');
	
	public function __construct($pdo){
		$this->cargarRoles($pdo);
		$this->cargarRecursos($pdo);
		$this->asociarRecursos($pdo);
	}
	
	private function cargarRoles($pdo){
		$this->addRole('alumno');
		$this->addRole('profesor','alumno');
		$this->addRole('administrativo','profesor');
		$this->addRole('jefedeestudios','administrativo');
	}
	
	private function cargarRecursos($pdo){
		$this->addResource('/alumnos');
		$this->addResource('/alumnos/importar');
		
		$this->addResource('/partes');
	}
	
	private function asociarRecursos($pdo){
		$this->allow('profesor', '/alumnos', null);
		$this->allow('jefedeestudios', '/partes', null);
	}
		
}
	
?>
